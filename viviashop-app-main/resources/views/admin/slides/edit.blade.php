@extends('layouts.app')

@section('content')
    <section class="content pt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-edit mr-2"></i>Edit Slide
                </h3>
                <a href="{{ route('admin.slides.index') }}" class="btn btn-success shadow-sm float-right">
                  <i class="fa fa-arrow-left"></i> Kembali
                </a>
              </div>
              <div class="card-body">
                <form method="post" action="{{ route('admin.slides.update', $slide) }}" enctype="multipart/form-data" id="slide-form">
                    @csrf
                    @method('put')

                    <div class="form-group row border-bottom pb-4">
                        <label for="title" class="col-sm-2 col-form-label">
                          Judul <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            name="title"
                            value="{{ old('title', $slide->title) }}"
                            id="title"
                            placeholder="Masukkan judul slide"
                            required
                          >
                          @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          <small class="form-text text-muted">Nama atau judul untuk slide banner.</small>
                        </div>
                    </div>

                    <div class="form-group row border-bottom pb-4">
                        <label for="url" class="col-sm-2 col-form-label">URL <small class="text-muted">(Opsional)</small></label>
                        <div class="col-sm-10">
                          <input
                            type="url"
                            class="form-control @error('url') is-invalid @enderror"
                            name="url"
                            value="{{ old('url', $slide->url) }}"
                            id="url"
                            placeholder="https://viviashop.com/promo/example"
                          >
                          @error('url')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          <small class="form-text text-muted">
                            Tautan tujuan saat slide diklik. Contoh: <code>https://viviashop.com/promo/example</code>
                          </small>
                        </div>
                    </div>

                    <div class="form-group row border-bottom pb-4">
                        <label class="col-sm-2 col-form-label">
                          Gambar <small class="text-muted">(Opsional)</small>
                        </label>
                        <div class="col-sm-10">
                          @if($slide->path)
                          <div class="mb-3">
                            <label class="d-block text-muted small mb-2">Gambar Saat Ini:</label>
                            <div class="preview-wrapper">
                              <img
                                id="current-image"
                                class="img-fluid img-thumbnail"
                                src="{{ $slide->image_url }}"
                                alt="{{ $slide->title }}"
                                style="max-height: 200px; cursor: pointer;"
                                title="Klik untuk melihat ukuran penuh"
                              >
                            </div>
                          </div>
                          <div class="alert alert-info py-2 px-3 small">
                            <i class="fa fa-info-circle"></i> Upload gambar baru jika ingin mengganti gambar saat ini.
                          </div>
                          @endif

                          <div
                            id="upload-zone"
                            class="upload-zone @error('path') upload-zone-error @enderror"
                          >
                            <div class="upload-zone-content">
                              <i class="fa fa-cloud-upload upload-icon"></i>
                              <p class="upload-text">Seret & lepas gambar di sini</p>
                              <p class="upload-subtext">atau klik untuk memilih file</p>
                            </div>
                            <input
                              type="file"
                              class="upload-input"
                              name="path"
                              id="path"
                              accept="image/jpeg,image/png,image/gif,image/webp"
                            >
                          </div>

                          @error('path')
                            <div class="text-danger mt-2">{{ $message }}</div>
                          @enderror

                          <div id="file-info" class="file-info mt-2"></div>
                          <div id="file-error" class="text-danger mt-2 d-none"></div>

                          <div id="image-preview-container" class="d-none mt-3">
                            <div class="preview-wrapper">
                              <img id="image-preview" class="img-preview img-fluid img-thumbnail" src="" alt="Preview">
                            </div>
                          </div>

                          <div id="dimension-info" class="dimension-info mt-2 d-none"></div>

                          <small class="form-text text-muted mt-2">
                            Format: <strong>JPG, PNG, GIF, WebP</strong>. Ukuran maksimal: <strong>4MB</strong>.
                            Kosongkan jika tidak ingin mengubah gambar.
                          </small>
                        </div>
                    </div>

                    <div class="form-group row border-bottom pb-4">
                        <label for="body" class="col-sm-2 col-form-label">
                          Deskripsi <small class="text-muted">(Opsional)</small>
                        </label>
                        <div class="col-sm-10">
                          <textarea
                            class="form-control @error('body') is-invalid @enderror"
                            name="body"
                            id="body"
                            rows="3"
                            placeholder="Deskripsi tambahan untuk slide (opsional)"
                          >{{ old('body', $slide->body) }}</textarea>
                          @error('body')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          <small class="form-text text-muted">
                            Teks deskripsi atau keterangan tambahan yang akan ditampilkan di slide.
                          </small>
                        </div>
                    </div>

                    <div class="form-group row border-bottom pb-4">
                        <label for="status" class="col-sm-2 col-form-label">
                          Status <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                          <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                            @foreach($statuses as $value => $status)
                              <option {{ old('status', $slide->status) == $value ? 'selected' : null }} value="{{ $value }}">
                                {{ $status }}
                              </option>
                            @endforeach
                          </select>
                          @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          <small class="form-text text-muted">
                            <strong>Active:</strong> Slide ditampilkan di halaman depan.
                            <strong>Inactive:</strong> Slide disembunyikan.
                          </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                          <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save mr-1"></i> Simpan Perubahan
                          </button>
                          <a href="{{ route('admin.slides.index') }}" class="btn btn-default px-4 ml-2">
                            Batal
                          </a>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('style-alt')
<style>
.upload-zone {
    border: 2px dashed #ced4da;
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
    position: relative;
}
.upload-zone:hover,
.upload-zone.dragover {
    border-color: #28a745;
    background: #f0fff4;
}
.upload-zone-error {
    border-color: #dc3545;
}
.upload-zone-content {
    pointer-events: none;
}
.upload-icon {
    font-size: 48px;
    color: #6c757d;
    margin-bottom: 10px;
    transition: color 0.3s ease;
}
.upload-zone:hover .upload-icon,
.upload-zone.dragover .upload-icon {
    color: #28a745;
}
.upload-text {
    font-size: 16px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
}
.upload-subtext {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 0;
}
.upload-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    pointer-events: none;
}
.preview-wrapper {
    max-width: 400px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.file-info {
    font-size: 13px;
    font-weight: 500;
}
.dimension-info {
    font-size: 12px;
}
.btn-default {
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    color: #444;
}
.btn-default:hover {
    background-color: #e7e7e7;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/slide-form.js') }}"></script>
@endpush
