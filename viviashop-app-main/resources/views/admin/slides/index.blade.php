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
              <div class="card-body p-0">
                @if($slides->count())
                <div class="table-responsive">
                    <table id="slide-table" class="table table-hover table-striped m-0">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center" width="50">#</th>
                        <th width="200">Gambar</th>
                        <th>Judul</th>
                        <th class="text-center" width="130">Status</th>
                        <th class="text-center" width="160">Urutan</th>
                        <th class="text-center" width="130">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($slides as $slide)
                            <tr>
                                <td class="text-center align-middle text-muted">{{ $slide->id }}</td>
                                <td class="align-middle">
                                  <div class="slide-img-wrap">
                                    <img
                                      class="img-fluid slide-img"
                                      src="{{ $slide->image_url }}"
                                      alt="{{ $slide->title }}"
                                      onclick="openSlidePreview(this.src)"
                                    >
                                    <div class="slide-img-overlay" onclick="openSlidePreview(this.parentElement.querySelector('img').src)">
                                      <i class="fa fa-search-plus"></i>
                                    </div>
                                  </div>
                                </td>
                                <td class="align-middle">
                                  <div class="d-flex flex-column">
                                    <strong class="slide-title">{{ $slide->title }}</strong>
                                    @if($slide->url)
                                      <small class="text-muted">
                                        <i class="fa fa-link fa-fw text-primary"></i>
                                        <a href="{{ $slide->url }}" target="_blank" class="text-muted">{{ Str::limit($slide->url, 35) }}</a>
                                      </small>
                                    @endif
                                    @if($slide->body)
                                      <small class="text-muted mt-1">
                                        <i class="fa fa-align-left fa-fw text-info"></i>
                                        {{ Str::limit($slide->body, 60) }}
                                      </small>
                                    @endif
                                  </div>
                                </td>
                                <td class="text-center align-middle">
                                  @if ($slide->status === 'active')
                                    <span class="badge badge-success px-3 py-1">
                                      <i class="fa fa-check-circle mr-1"></i>Aktif
                                    </span>
                                  @else
                                    <span class="badge badge-secondary px-3 py-1">
                                      <i class="fa fa-times-circle mr-1"></i>Tidak Aktif
                                    </span>
                                  @endif
                                </td>
                                <td class="text-center align-middle">
                                  <div class="d-flex align-items-center justify-content-center" style="gap: 4px;">
                                    @if ($slide->prevSlide())
                                      <a href="{{ url('admin/slides/' . $slide->id . '/up') }}"
                                         class="btn btn-outline-primary btn-sm"
                                         title="Pindah ke atas"
                                         data-toggle="tooltip">
                                        <i class="fa fa-chevron-up"></i>
                                      </a>
                                    @else
                                      <button class="btn btn-outline-secondary btn-sm" disabled>
                                        <i class="fa fa-chevron-up"></i>
                                      </button>
                                    @endif
                                    <span class="badge badge-light border px-2 py-1 mx-1" style="font-size: 13px; min-width: 32px;">
                                      {{ $slide->position }}
                                    </span>
                                    @if ($slide->nextSlide())
                                      <a href="{{ url('admin/slides/' . $slide->id . '/down') }}"
                                         class="btn btn-outline-primary btn-sm"
                                         title="Pindah ke bawah"
                                         data-toggle="tooltip">
                                        <i class="fa fa-chevron-down"></i>
                                      </a>
                                    @else
                                      <button class="btn btn-outline-secondary btn-sm" disabled>
                                        <i class="fa fa-chevron-down"></i>
                                      </button>
                                    @endif
                                  </div>
                                </td>
                                <td class="text-center align-middle">
                                  <div class="btn-group">
                                    <a href="{{ route('admin.slides.edit', $slide) }}"
                                       class="btn btn-outline-info btn-sm"
                                       title="Edit slide"
                                       data-toggle="tooltip">
                                      <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm btn-delete-slide"
                                            data-url="{{ route('admin.slides.destroy', $slide) }}"
                                            data-title="{{ $slide->title }}"
                                            title="Hapus slide"
                                            data-toggle="tooltip">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                  <i class="fa fa-sliders-h fa-4x text-muted mb-3 d-block"></i>
                  <h5 class="text-muted">Belum Ada Slide</h5>
                  <p class="text-muted mb-3">Mulai dengan menambahkan slide banner pertama Anda.</p>
                  <a href="{{ route('admin.slides.create') }}" class="btn btn-success px-4">
                    <i class="fa fa-plus mr-1"></i> Tambah Slide Baru
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  <style>
  .card-primary.card-outline {
      border-top: 3px solid #007bff;
  }
  .slide-img-wrap {
      position: relative;
      width: 160px;
      height: 80px;
      border-radius: 6px;
      overflow: hidden;
      border: 1px solid #e9ecef;
      background: #f8f9fa;
  }
  .slide-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
  }
  .slide-img-wrap:hover .slide-img {
      transform: scale(1.1);
  }
  .slide-img-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
      cursor: pointer;
      color: white;
      font-size: 20px;
  }
  .slide-img-wrap:hover .slide-img-overlay {
      opacity: 1;
  }
  .slide-title {
      font-size: 14px;
      line-height: 1.3;
  }
  #slide-table th {
      border-bottom: 2px solid #dee2e6 !important;
      font-weight: 600;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #6c757d;
  }
  #slide-table td {
      vertical-align: middle;
      font-size: 13px;
  }
  .btn-outline-primary.btn-sm,
  .btn-outline-info.btn-sm,
  .btn-outline-danger.btn-sm {
      padding: 3px 8px;
      font-size: 12px;
  }
  .btn-outline-secondary:disabled {
      opacity: 0.25;
      cursor: not-allowed;
  }
  </style>
@endpush

@push('script-alt')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
    function openSlidePreview(src) {
        $('#modal-image').attr('src', src);
        $('#image-modal').modal('show');
    }

    $(document).ready(function () {
        $('#slide-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.3/i18n/id.json'
            },
            pageLength: 25,
            order: [[4, 'asc']],
            columnDefs: [
                { targets: [0, 1, 3, 4, 5], orderable: false }
            ]
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('.btn-delete-slide').on('click', function () {
            var url = $(this).data('url');
            var title = $(this).data('title');

            Swal.fire({
                title: 'Hapus Slide',
                html: 'Apakah Anda yakin ingin menghapus slide <strong>"' + $('<span>').text(title).html() + '"</strong>?<br>Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
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