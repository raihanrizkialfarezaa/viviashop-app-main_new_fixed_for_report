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
    public function store(Request $request)
    {
        Log::debug('=== SLIDE STORE DEBUG ===');
        Log::debug('All input keys: ' . json_encode(array_keys($request->all())));
        Log::debug('Has path input: ' . ($request->has('path') ? 'yes' : 'no'));
        Log::debug('HasFile path: ' . ($request->hasFile('path') ? 'yes' : 'no'));
        Log::debug('Content-Type: ' . ($_SERVER['CONTENT_TYPE'] ?? 'not set'));
        Log::debug('Content-Length: ' . ($_SERVER['CONTENT_LENGTH'] ?? 'not set'));
        Log::debug('Request-Method: ' . ($_SERVER['REQUEST_METHOD'] ?? 'not set'));
        
        if ($request->hasFile('path')) {
            $file = $request->file('path');
            Log::debug('File original name: ' . $file->getClientOriginalName());
            Log::debug('File size: ' . $file->getSize());
            Log::debug('File mime: ' . $file->getMimeType());
            Log::debug('File valid: ' . ($file->isValid() ? 'yes' : 'no'));
            Log::debug('File error: ' . $file->getError());
            Log::debug('File path: ' . $file->getPathname());
            Log::debug('File realPath: ' . $file->getRealPath());
        } else {
            Log::debug('File path NOT present in $request->file()');
            Log::debug('$_FILES: ' . json_encode($_FILES, JSON_PRETTY_PRINT));
            Log::debug('$_POST: ' . json_encode($_POST));
            Log::debug('ini_get upload_max_filesize: ' . ini_get('upload_max_filesize'));
            Log::debug('ini_get post_max_size: ' . ini_get('post_max_size'));
            Log::debug('ini_get upload_tmp_dir: ' . ini_get('upload_tmp_dir'));
        }
        Log::debug('========================');

        try {
            $data = $request->except('_token', '_method');

            if ($request->hasFile('path')) {
                $data['path'] = $request->file('path')->store('assets/slides', 'public');
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
                if ($slide->path && Storage::disk('public')->exists($slide->path)) {
                    Storage::disk('public')->delete($slide->path);
                }
                $data['path'] = $request->file('path')->store('assets/slides', 'public');
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
            if ($slide->path && Storage::disk('public')->exists($slide->path)) {
                Storage::disk('public')->delete($slide->path);
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
}
