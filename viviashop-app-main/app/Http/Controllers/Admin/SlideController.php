<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slide::orderBy('position', 'ASC')->get();

        return view('admin.slides.index', compact('slides'));
    }

    public function moveUp($id)
	{
		$slide = Slide::findOrFail($id);

		if (!$slide->prevSlide()) {
			return redirect('admin/slides');
		}

		\DB::transaction(
			function () use ($slide) {
				$currentPosition = $slide->position;
				$prevPosition = $slide->prevSlide()->position;

				$prevSlide = Slide::find($slide->prevSlide()->id);
				$prevSlide->position = $currentPosition;
				$prevSlide->save();

				$slide->position = $prevPosition;
				$slide->save();
			}
		);

		return redirect('admin/slides');
    }

    public function moveDown($id)
	{
		$slide = Slide::findOrFail($id);

		if (!$slide->nextSlide()) {
			\Session::flash('error', 'Invalid position');
			return redirect('admin/slides');
		}

		\DB::transaction(
			function () use ($slide) {
				$currentPosition = $slide->position;
				$nextPosition = $slide->nextSlide()->position;

				$nextSlide = Slide::find($slide->nextSlide()->id);
				$nextSlide->position = $currentPosition;
				$nextSlide->save();

				$slide->position = $nextPosition;
				$slide->save();
			}
		);

		return redirect('admin/slides');
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Slide::STATUSES;

        return view('admin.slides.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlideRequest $request)
    {
        try {
            $data = $request->validated();

        if ($request->hasFile('path')) {
            // Upload to Cloudinary instead of local storage
            $file = $request->file('path');
            $data['path'] = \App\Http\Controllers\CloudinaryController::upload(
                $file->getRealPath(),
                $file->getClientOriginalName(),
                'slides' // Custom folder for slides
            );
        }

            $data['position'] = Slide::max('position') + 1;
            $data['user_id'] = auth()->id();

            Slide::create($data);

            return redirect()->route('admin.slides.index')->with([
                'message' => 'Slide berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan slide: ' . $e->getMessage());

            return redirect()->back()->withInput()->with([
                'message' => 'Gagal menambahkan slide. Silakan coba lagi.',
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        $statuses = Slide::STATUSES;

		return view('admin.slides.edit', compact('slide', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlideRequest $request, Slide $slide)
    {
        try {
            $data = $request->validated();

        if ($request->hasFile('path')) {
            // Delete old file (check if Cloudinary or local)
            if ($slide->path) {
                if ($this->isCloudinaryUrl($slide->path)) {
                    \App\Http\Controllers\CloudinaryController::delete($slide->path, 'slides');
                } elseif (Storage::disk('public')->exists($slide->path)) {
                    Storage::disk('public')->delete($slide->path);
                }
            }
            
            // Upload new file to Cloudinary
            $file = $request->file('path');
            $data['path'] = \App\Http\Controllers\CloudinaryController::upload(
                $file->getRealPath(),
                $file->getClientOriginalName(),
                'slides'
            );
        } else {
            unset($data['path']);
        }

            $data['user_id'] = auth()->id();

            $slide->update($data);

            return redirect()->route('admin.slides.index')->with([
                'message' => 'Slide berhasil diperbarui!',
                'alert-type' => 'info'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui slide: ' . $e->getMessage());

            return redirect()->back()->withInput()->with([
                'message' => 'Gagal memperbarui slide. Silakan coba lagi.',
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        try {
        if ($slide->path) {
            if ($this->isCloudinaryUrl($slide->path)) {
                // Delete from Cloudinary
                \App\Http\Controllers\CloudinaryController::delete($slide->path, 'slides');
            } elseif (Storage::disk('public')->exists($slide->path)) {
                // Delete from local storage
                Storage::disk('public')->delete($slide->path);
            }
        }

            $slide->delete();

            return redirect()->back()->with([
                'message' => 'Slide berhasil dihapus!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus slide: ' . $e->getMessage());

            return redirect()->back()->with([
                'message' => 'Gagal menghapus slide. Silakan coba lagi.',
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Check if path is a Cloudinary URL
     */
    private function isCloudinaryUrl($path)
    {
        return filter_var($path, FILTER_VALIDATE_URL) !== false && 
               str_contains($path, 'cloudinary.com');
    }
}
