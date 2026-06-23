@extends('layouts.app')

@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-outline card-primary shadow">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-sliders-h mr-2"></i>Slide Banner
                  <span class="badge badge-primary ml-2">{{ $slides->count() }}</span>
                </h3>
                <div class="card-tools">
                  <a href="{{ route('admin.slides.create') }}" class="btn btn-success btn-sm px-3">
                    <i class="fa fa-plus mr-1"></i> Tambah Slide
                  </a>
                </div>
              </div>
              <div class="card-body p-4">
                @if($slides->count())
                <div class="row" id="slides-grid">
                  @foreach ($slides as $slide)
                  <div class="col-md-6 col-lg-4 col-xl-3 mb-4" data-id="{{ $slide->id }}">
                    <div class="slide-card">
                      <div class="slide-card-header">
                        <span class="slide-position-badge">{{ $slide->position }}</span>
                        @if ($slide->status === 'active')
                          <span class="slide-status-badge badge-success">
                            <i class="fa fa-check-circle"></i> Aktif
                          </span>
                        @else
                          <span class="slide-status-badge badge-secondary">
                            <i class="fa fa-times-circle"></i> Nonaktif
                          </span>
                        @endif
                      </div>
                      
                      <div class="slide-card-image" onclick="openSlidePreview('{{ $slide->image_url }}')">
                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}">
                        <div class="slide-image-overlay">
                          <i class="fa fa-search-plus fa-2x"></i>
                        </div>
                      </div>
                      
                      <div class="slide-card-body">
                        <h5 class="slide-card-title">{{ $slide->title }}</h5>
                        @if($slide->body)
                          <p class="slide-card-description">{{ Str::limit($slide->body, 80) }}</p>
                        @endif
                        @if($slide->url)
                          <div class="slide-card-link">
                            <i class="fa fa-link"></i>
                            <a href="{{ $slide->url }}" target="_blank">{{ Str::limit($slide->url, 30) }}</a>
                          </div>
                        @endif
                      </div>
                      
                      <div class="slide-card-footer">
                        <div class="slide-card-actions">
                          <a href="{{ route('admin.slides.edit', $slide) }}" 
                             class="btn btn-sm btn-info" 
                             title="Edit">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                          <button type="button" 
                                  class="btn btn-sm btn-danger btn-delete-slide"
                                  data-url="{{ route('admin.slides.destroy', $slide) }}"
                                  data-title="{{ $slide->title }}"
                                  title="Hapus">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                        <div class="slide-card-meta">
                          <small class="text-muted">
                            <i class="fa fa-clock"></i> {{ $slide->updated_at->diffForHumans() }}
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                @else
                <div class="empty-state">
                  <div class="empty-state-icon">
                    <i class="fa fa-images"></i>
                  </div>
                  <h4 class="empty-state-title">Belum Ada Slide Banner</h4>
                  <p class="empty-state-text">Buat slide banner pertama untuk mempercantik halaman utama website Anda.</p>
                  <a href="{{ route('admin.slides.create') }}" class="btn btn-success btn-lg">
                    <i class="fa fa-plus mr-2"></i> Buat Slide Pertama
                  </a>
                </div>
                @endif
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0 bg-dark text-center rounded">
            <img id="modal-image" class="img-fluid rounded" src="" alt="Preview" style="max-height: 80vh;">
          </div>
          <div class="modal-footer border-0 py-1">
            <button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('style-alt')
  <style>
  /* Card Container */
  .slide-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
  }
  .slide-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
  }
  
  /* Card Header */
  .slide-card-header {
      position: absolute;
      top: 12px;
      left: 12px;
      right: 12px;
      z-index: 10;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
  }
  .slide-position-badge {
      background: rgba(0,0,0,0.75);
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 13px;
      backdrop-filter: blur(8px);
  }
  .slide-status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      backdrop-filter: blur(8px);
      display: flex;
      align-items: center;
      gap: 4px;
  }
  .slide-status-badge.badge-success {
      background: rgba(40, 167, 69, 0.95);
      color: white;
  }
  .slide-status-badge.badge-secondary {
      background: rgba(108, 117, 125, 0.95);
      color: white;
  }
  
  /* Card Image */
  .slide-card-image {
      position: relative;
      width: 100%;
      padding-top: 56.25%; /* 16:9 aspect ratio */
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      overflow: hidden;
      cursor: pointer;
  }
  .slide-card-image img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
  }
  .slide-card-image:hover img {
      transform: scale(1.08);
  }
  .slide-image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
      color: white;
  }
  .slide-card-image:hover .slide-image-overlay {
      opacity: 1;
  }
  
  /* Card Body */
  .slide-card-body {
      padding: 16px;
      flex: 1;
  }
  .slide-card-title {
      font-size: 16px;
      font-weight: 600;
      color: #2d3748;
      margin: 0 0 8px 0;
      line-height: 1.4;
  }
  .slide-card-description {
      font-size: 13px;
      color: #718096;
      margin: 0 0 12px 0;
      line-height: 1.5;
  }
  .slide-card-link {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      color: #4299e1;
  }
  .slide-card-link i {
      font-size: 11px;
  }
  .slide-card-link a {
      color: #4299e1;
      text-decoration: none;
  }
  .slide-card-link a:hover {
      text-decoration: underline;
  }
  
  /* Card Footer */
  .slide-card-footer {
      padding: 12px 16px;
      background: #f7fafc;
      border-top: 1px solid #e2e8f0;
      display: flex;
      justify-content: space-between;
      align-items: center;
  }
  .slide-card-actions {
      display: flex;
      gap: 6px;
  }
  .slide-card-actions .btn {
      padding: 6px 12px;
      font-size: 12px;
      font-weight: 500;
  }
  .slide-card-meta {
      font-size: 11px;
      color: #a0aec0;
  }
  .slide-card-meta i {
      margin-right: 4px;
  }
  
  /* Empty State */
  .empty-state {
      text-align: center;
      padding: 80px 20px;
  }
  .empty-state-icon {
      font-size: 72px;
      color: #cbd5e0;
      margin-bottom: 24px;
  }
  .empty-state-title {
      font-size: 24px;
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 12px;
  }
  .empty-state-text {
      font-size: 16px;
      color: #718096;
      margin-bottom: 32px;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
  }
  
  /* Grid Responsive */
  #slides-grid {
      margin: 0 -8px;
  }
  #slides-grid > [class*="col-"] {
      padding: 0 8px;
  }
  
  /* Modal Enhancements */
  #image-modal .modal-content {
      border: none;
      background: transparent;
  }
  #image-modal .modal-body {
      background: #1a202c;
  }
  </style>
@endpush

@push('script-alt')
    <script>
    function openSlidePreview(src) {
        $('#modal-image').attr('src', src);
        $('#image-modal').modal('show');
    }

    $(document).ready(function () {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Delete confirmation
        $('.btn-delete-slide').on('click', function () {
            var url = $(this).data('url');
            var title = $(this).data('title');

            Swal.fire({
                title: 'Hapus Slide',
                html: 'Apakah Anda yakin ingin menghapus slide <strong>"' + $('<span>').text(title).html() + '"</strong>?<br><small class="text-muted">Gambar akan dihapus dari Cloudinary.</small><br>Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa fa-trash mr-1"></i> Ya, hapus!',
                cancelButtonText: '<i class="fa fa-times mr-1"></i> Batal',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        var form = document.getElementById('delete-form');
                        form.action = url;
                        form.submit();
                    });
                }
            });
        });
    });
    </script>
@endpush