@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <h2>Stock Opname <small class="text-muted" style="font-size: 14px;">— Bandingkan & Sesuaikan Stok</small></h2>
                        <div>
                            <span class="badge badge-info" id="status-badge">
                                {{ count($products) }} produk
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Masukkan stok fisik untuk setiap produk. Sistem akan menghitung selisih dan menyesuaikan stok secara otomatis.
                                    Untuk produk dengan varian (konfigurabel), stok akan didistribusikan secara proporsional ke setiap varian.
                                </div>
                            </div>
                        </div>

                        <form id="opname-form">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="opname-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 35px;">
                                                <input type="checkbox" id="select-all">
                                            </th>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Type</th>
                                            <th style="width: 120px; text-align: center;">System Stock</th>
                                            <th style="width: 140px; text-align: center;">Physical Stock</th>
                                            <th style="width: 100px; text-align: center;">Difference</th>
                                            <th style="width: 80px; text-align: center;">Variants</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr data-product-id="{{ $product->id }}"
                                                data-type="{{ $product->type }}"
                                                data-system-stock="{{ $product->system_stock }}">
                                                <td>
                                                    <input type="checkbox" class="product-checkbox" name="items[{{ $product->id }}][selected]" value="1" checked>
                                                    <input type="hidden" name="items[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                                                </td>
                                                <td>
                                                    <strong>{{ $product->name }}</strong>
                                                    @if($product->variant_count > 0)
                                                        <button type="button" class="btn btn-sm btn-link p-0 ml-2 show-variants"
                                                            data-product-id="{{ $product->id }}"
                                                            title="Show variants">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <div class="variant-detail" id="variant-detail-{{ $product->id }}" style="display: none;"></div>
                                                    @endif
                                                </td>
                                                <td>{{ $product->sku }}</td>
                                                <td>
                                                    @if($product->variant_count > 0)
                                                        <span class="badge badge-warning">Configurable</span>
                                                    @else
                                                        <span class="badge badge-secondary">Simple</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <span class="system-stock">{{ number_format($product->system_stock, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control form-control-sm physical-stock text-center"
                                                        name="items[{{ $product->id }}][physical_stock]"
                                                        value="{{ $product->system_stock }}"
                                                        min="0"
                                                        style="width: 120px; display: inline-block;">
                                                </td>
                                                <td class="text-center">
                                                    <span class="difference-badge badge badge-secondary">0</span>
                                                </td>
                                                <td class="text-center">
                                                    @if($product->variant_count > 0)
                                                        <span class="badge badge-info">{{ $product->variant_count }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada produk ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body py-2">
                                            <strong>Summary:</strong>
                                            <span id="selected-count">{{ count($products) }}</span> selected |
                                            <span id="changed-count">0</span> changed
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">
                                        <i class="fas fa-save"></i> Proses Opname
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div id="result-area" style="display: none;" class="mt-4">
                            <hr>
                            <h4 class="mb-3">Result</h4>
                            <div id="result-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Variant Modal -->
    <div class="modal fade" id="variantModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Variant Stock Detail</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="variant-modal-body">
                    <div class="text-center py-3">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Loading variants...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-alt')
    <style>
        .physical-stock:focus {
            border-color: #4a90d9;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 217, 0.25);
        }
        .physical-stock.changed {
            background-color: #fff3cd;
            border-color: #ffc107;
        }
        #opname-table td {
            vertical-align: middle;
        }
        .variant-detail {
            margin-top: 8px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 4px;
            font-size: 13px;
        }
        .variant-detail table {
            margin-bottom: 0;
        }
        .variant-detail td, .variant-detail th {
            padding: 4px 8px;
        }
    </style>
@endpush

@push('script-alt')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(function() {
            calculateDifferences();

            $('.physical-stock').on('input', function() {
                const $row = $(this).closest('tr');
                const systemStock = parseInt($row.data('system-stock'));
                const physicalStock = parseInt($(this).val()) || 0;
                const diff = physicalStock - systemStock;

                const $badge = $row.find('.difference-badge');
                $badge.text(formatNumber(diff));
                $badge.removeClass('badge-secondary badge-success badge-danger badge-warning');
                if (diff > 0) {
                    $badge.addClass('badge-success');
                    $badge.text('+' + formatNumber(diff));
                } else if (diff < 0) {
                    $badge.addClass('badge-danger');
                } else {
                    $badge.addClass('badge-secondary');
                }

                $(this).toggleClass('changed', diff !== 0);
                updateSummary();
            });

            $('#select-all').on('change', function() {
                $('.product-checkbox').prop('checked', $(this).is(':checked'));
                updateSummary();
            });

            $('.product-checkbox').on('change', updateSummary);

            $('.show-variants').on('click', function() {
                const productId = $(this).data('product-id');
                showVariants(productId);
            });

            $('#opname-form').on('submit', function(e) {
                e.preventDefault();
                submitOpname();
            });

            updateSummary();
        });

        function formatNumber(n) {
            return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function calculateDifferences() {
            $('.physical-stock').trigger('input');
        }

        function updateSummary() {
            let changed = 0;
            let selected = 0;

            $('.product-checkbox:checked').each(function() {
                selected++;
                const $row = $(this).closest('tr');
                const systemStock = parseInt($row.data('system-stock'));
                const physicalStock = parseInt($row.find('.physical-stock').val()) || 0;
                if (physicalStock !== systemStock) changed++;
            });

            $('#selected-count').text(selected);
            $('#changed-count').text(changed);
        }

        function resetForm() {
            $('.physical-stock').each(function() {
                const $row = $(this).closest('tr');
                $(this).val($row.data('system-stock'));
            });
            $('.product-checkbox').prop('checked', true);
            $('#select-all').prop('checked', true);
            calculateDifferences();
            $('#result-area').hide();
        }

        function showVariants(productId) {
            const $modal = $('#variantModal');
            const $body = $('#variant-modal-body');
            $body.html('<div class="text-center py-3"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading variants...</p></div>');
            $modal.modal('show');

            $.get('/admin/stock-opname/' + productId + '/variants')
                .done(function(data) {
                    if (data.variants.length === 0) {
                        $body.html('<p class="text-muted text-center">No variants found</p>');
                        return;
                    }
                    let html = '<table class="table table-sm table-bordered mb-0">';
                    html += '<thead><tr><th>Variant</th><th>SKU</th><th>Paper</th><th>Type</th><th class="text-center">Stock</th></tr></thead><tbody>';
                    data.variants.forEach(function(v) {
                        html += '<tr>';
                        html += '<td>' + v.name + '</td>';
                        html += '<td>' + v.sku + '</td>';
                        html += '<td>' + (v.paper_size || '-') + '</td>';
                        html += '<td>' + (v.print_type || '-') + '</td>';
                        html += '<td class="text-center">' + formatNumber(v.stock) + '</td>';
                        html += '</tr>';
                    });
                    html += '</tbody></table>';
                    $body.html(html);
                })
                .fail(function() {
                    $body.html('<p class="text-danger text-center">Failed to load variants</p>');
                });
        }

        function submitOpname() {
            const items = {};
            let hasItems = false;

            $('.product-checkbox:checked').each(function() {
                const $row = $(this).closest('tr');
                const productId = $row.data('product-id');
                const physicalStock = parseInt($row.find('.physical-stock').val()) || 0;

                if ($row.data('system-stock') !== physicalStock) {
                    hasItems = true;
                }

                items[productId] = {
                    product_id: productId,
                    physical_stock: physicalStock,
                };
            });

            if (!hasItems) {
                alert('Tidak ada perubahan stok untuk diproses.');
                return;
            }

            const $btn = $('#submit-btn');
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
            $('#result-area').hide();

            $.ajax({
                url: '{{ route('admin.stock-opname.process') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: JSON.stringify({ items: Object.values(items) }),
                contentType: 'application/json',
                success: function(data) {
                    let html = '';

                    if (data.success) {
                        html += '<div class="alert alert-success">';
                        html += '<i class="fas fa-check-circle"></i> ' + data.message;
                        html += ' <strong>' + data.total_adjusted + '</strong> produk disesuaikan.';
                        html += '</div>';

                        html += '<table class="table table-sm table-bordered">';
                        html += '<thead><tr><th>Product</th><th class="text-center">Old Stock</th><th class="text-center">New Stock</th><th class="text-center">Difference</th><th class="text-center">Status</th></tr></thead><tbody>';

                        data.results.forEach(function(r) {
                            const statusClass = r.difference > 0 ? 'success' : (r.difference < 0 ? 'danger' : 'secondary');
                            const diffText = r.difference > 0 ? '+' + formatNumber(r.difference) : formatNumber(r.difference);
                            const statusIcon = r.difference > 0 ? 'arrow-up' : (r.difference < 0 ? 'arrow-down' : 'minus');
                            html += '<tr>';
                            html += '<td>' + r.product_name + '</td>';
                            html += '<td class="text-center">' + formatNumber(r.old_stock) + '</td>';
                            html += '<td class="text-center">' + formatNumber(r.new_stock) + '</td>';
                            html += '<td class="text-center"><span class="badge badge-' + statusClass + '">' + diffText + '</span></td>';
                            html += '<td class="text-center"><i class="fas fa-' + statusIcon + ' text-' + statusClass + '"></i></td>';
                            html += '</tr>';
                        });

                        html += '</tbody></table>';

                        // Update UI with new stock values
                        data.results.forEach(function(r) {
                            $('tr[data-product-id]').each(function() {
                                const $row = $(this);
                                const name = $.trim($row.find('td:eq(1)').text());
                                if (name === r.product_name) {
                                    $row.data('system-stock', r.new_stock);
                                    $row.find('.system-stock').text(formatNumber(r.new_stock));
                                    $row.find('.physical-stock').val(r.new_stock);
                                    $row.find('.physical-stock').trigger('input');
                                }
                            });
                        });
                    } else {
                        html += '<div class="alert alert-danger">';
                        html += '<i class="fas fa-exclamation-circle"></i> ' + data.message;
                        html += '</div>';
                    }

                    $('#result-content').html(html);
                    $('#result-area').show();
                    $('#result-area')[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
                    updateSummary();
                },
                error: function(xhr) {
                    let msg = 'Terjadi kesalahan saat memproses opname.';
                    try {
                        const resp = JSON.parse(xhr.responseText);
                        msg = resp.message || msg;
                    } catch(e) {}
                    $('#result-content').html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ' + msg + '</div>');
                    $('#result-area').show();
                },
                complete: function() {
                    $btn.prop('disabled', false).html('<i class="fas fa-save"></i> Proses Opname');
                }
            });
        }
    </script>
@endpush
