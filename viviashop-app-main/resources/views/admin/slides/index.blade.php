@extends('layouts.app')

@section('content')
    <section class="content pt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-sliders-h mr-2"></i>Data Slide
                  <span class="badge badge-info ml-2">{{ $slides->count() }}</span>
                </h3>
                <a href="{{ route('admin.slides.create') }}" class="btn btn-success shadow-sm float-right">
                  <i class="fa fa-plus"></i> Tambah Slide
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="50">No</th>
                        <th>Judul</th>
                        <th width="220">Gambar</th>
                        <th class="text-center" width="180">Posisi</th>
                        <th class="text-center" width="100">Status</th>
                        <th class="text-center" width="120">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($slides as $slide)
                            <tr>
                                <td class="text-center">{{ $slide->id }}</td>
                                <td>
                                  <strong>{{ $slide->title }}</strong>
                                  @if($slide->url)
                                    <br><small class="text-muted"><i class="fa fa-link"></i> {{ Str::limit($slide->url, 40) }}</small>
                                  @endif
                                </td>
                                <td>
                                  <img
                                    class="img-thumbnail slide-thumb"
                                    src="{{ asset('storage/' . $slide->path) }}"
                                    alt="{{ $slide->title }}"
                                    onclick="window.open(this.src, '_blank')"
                                    style="cursor: pointer;"
                                  >
                                </td>
                                <td class="text-center">
                                  <div class="btn-group btn-group-xs">
                                    @if ($slide->prevSlide())
                                      <a href="{{ url('admin/slides/' . $slide->id . '/up') }}"
                                         class="btn btn-outline-secondary"
                                         title="Pindah ke atas"
                                         data-toggle="tooltip">
                                        <i class="fa fa-chevron-up"></i>
                                      </a>
                                    @else
                                      <button class="btn btn-outline-secondary" disabled>
                                        <i class="fa fa-chevron-up"></i>
                                      </button>
                                    @endif
                                    @if ($slide->nextSlide())
                                      <a href="{{ url('admin/slides/' . $slide->id . '/down') }}"
                                         class="btn btn-outline-secondary"
                                         title="Pindah ke bawah"
                                         data-toggle="tooltip">
                                        <i class="fa fa-chevron-down"></i>
                                      </a>
                                    @else
                                      <button class="btn btn-outline-secondary" disabled>
                                        <i class="fa fa-chevron-down"></i>
                                      </button>
                                    @endif
                                  </div>
                                  <div class="mt-1">
                                    <span class="badge badge-light position-badge">
                                      <i class="fa fa-sort"></i> {{ $slide->position }}
                                    </span>
                                  </div>
                                </td>
                                <td class="text-center">
                                  @if ($slide->status === 'active')
                                    <span class="badge badge-success px-3 py-2">
                                      <i class="fa fa-check-circle"></i> Active
                                    </span>
                                  @else
                                    <span class="badge badge-secondary px-3 py-2">
                                      <i class="fa fa-times-circle"></i> Inactive
                                    </span>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.slides.edit', $slide) }}"
                                       class="btn btn-primary"
                                       title="Edit slide"
                                       data-toggle="tooltip">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger btn-delete-slide"
                                            data-url="{{ route('admin.slides.destroy', $slide) }}"
                                            data-title="{{ $slide->title }}"
                                            title="Hapus slide"
                                            data-toggle="tooltip">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                  <i class="fa fa-sliders-h fa-3x mb-3 d-block"></i>
                                  Belum ada slide. <a href="{{ route('admin.slides.create') }}">Tambah slide baru</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
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
@endsection

@push('style-alt')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  <style>
  .slide-thumb {
      max-height: 80px;
      transition: transform 0.2s ease;
  }
  .slide-thumb:hover {
      transform: scale(1.8);
      z-index: 10;
      position: relative;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  }
  .btn-group-xs > .btn {
      padding: 2px 8px;
      font-size: 11px;
      line-height: 1.5;
  }
  .position-badge {
      font-size: 11px;
      font-weight: normal;
  }
  .btn-outline-secondary:disabled {
      opacity: 0.3;
      cursor: not-allowed;
  }
  </style>
@endpush

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#data-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.3/i18n/id.json'
            }
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('.btn-delete-slide').on('click', function () {
            var url = $(this).data('url');
            var title = $(this).data('title');

            Swal.fire({
                title: 'Hapus Slide',
                html: 'Apakah Anda yakin ingin menghapus slide <strong>"' + title + '"</strong>?',
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