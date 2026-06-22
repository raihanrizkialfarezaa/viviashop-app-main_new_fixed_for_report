@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <h2>PDF Report Tester <small class="text-muted" style="font-size: 14px;">— Product Report</small></h2>
                        <span class="badge badge-info" id="status-badge">Ready</span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" id="start-date"
                                        value="{{ date('Y-m-01') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" id="end-date"
                                        value="{{ date('Y-m-t') }}">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="form-group w-100">
                                    <button class="btn btn-primary btn-block" id="run-test-btn" onclick="runTest()">
                                        <i class="fas fa-play"></i> Run Test
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="result-area" style="display: none;">
                            <hr>
                            <h4 class="mb-3">Test Results</h4>

                            <div class="row mb-4" id="metrics-row">
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center py-3">
                                            <h6 class="text-muted mb-1">Status</h6>
                                            <h4 id="result-status" class="mb-0">-</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center py-3">
                                            <h6 class="text-muted mb-1">HTTP Code</h6>
                                            <h4 id="result-http-code" class="mb-0">-</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center py-3">
                                            <h6 class="text-muted mb-1">File Size</h6>
                                            <h4 id="result-size" class="mb-0">-</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center py-3">
                                            <h6 class="text-muted mb-1">Time</h6>
                                            <h4 id="result-time" class="mb-0">-</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="success-detail" style="display: none;">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i>
                                    <span id="success-message">PDF berhasil digenerate</span>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body py-3">
                                                <h6 class="text-muted mb-1">Total Products</h6>
                                                <h4 id="result-products" class="mb-0">-</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body py-3">
                                                <h6 class="text-muted mb-1">Download</h6>
                                                <a id="download-link" href="#" class="btn btn-success btn-sm mt-2" target="_blank">
                                                    <i class="fas fa-download"></i> Download PDF
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">PDF Preview <small class="text-muted">(Screenshot Simulation)</small></h6>
                                    </div>
                                    <div class="card-body text-center" style="background: #f8f9fa; min-height: 200px; position: relative; overflow: hidden;">
                                        <div style="border: 2px dashed #ccc; border-radius: 8px; padding: 20px; background: white; max-width: 800px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                            <div style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                                                <strong style="font-size: 16px;">Product Report</strong>
                                                <span style="font-size: 12px; color: #666;" id="preview-period"></span>
                                            </div>
                                            <div style="overflow-x: auto;">
                                                <table style="width: 100%; border-collapse: collapse; font-size: 12px;" id="preview-table">
                                                    <thead>
                                                        <tr style="background: #4a90d9; color: white;">
                                                            <th style="padding: 8px; text-align: left;">Name</th>
                                                            <th style="padding: 8px; text-align: left;">SKU</th>
                                                            <th style="padding: 8px; text-align: right;">Sold</th>
                                                            <th style="padding: 8px; text-align: right;">Revenue</th>
                                                            <th style="padding: 8px; text-align: right;">Orders</th>
                                                            <th style="padding: 8px; text-align: right;">Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="preview-tbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div style="margin-top: 20px; padding-top: 10px; border-top: 1px solid #ddd; font-size: 11px; color: #999; text-align: center;">
                                                Generated by ViViaShop PDF Report Tester
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="error-detail" style="display: none;">
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span id="error-message"></span>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Code Analysis</h6>
                                        <span id="error-location" class="badge badge-danger"></span>
                                    </div>
                                    <div class="card-body p-0">
                                        <pre id="error-code-snippet"
                                            style="margin: 0; padding: 15px; background: #1e1e1e; color: #d4d4d4; overflow-x: auto; font-size: 13px; line-height: 1.5; border-radius: 0 0 4px 4px;">
                                        </pre>
                                    </div>
                                </div>
                            </div>

                            <div id="loading-detail" style="display: none;">
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <h5>Generating PDF Report...</h5>
                                    <p class="text-muted">Please wait while the report is being generated.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-alt')
    <style>
        #error-code-snippet .line-highlight {
            background: rgba(255, 0, 0, 0.2);
            display: block;
            margin: 0 -15px;
            padding: 0 15px;
            border-left: 3px solid #ff5555;
        }
        #error-code-snippet .line-number {
            color: #858585;
            user-select: none;
        }
        #error-code-snippet .line-arrow {
            color: #ff5555;
            user-select: none;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .status-running #status-badge {
            animation: pulse 1s infinite;
        }
    </style>
@endpush

@push('script-alt')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        function runTest() {
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const btn = document.getElementById('run-test-btn');
            const resultArea = document.getElementById('result-area');
            const loadingDetail = document.getElementById('loading-detail');
            const successDetail = document.getElementById('success-detail');
            const errorDetail = document.getElementById('error-detail');
            const statusBadge = document.getElementById('status-badge');

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Testing...';
            resultArea.style.display = 'block';
            loadingDetail.style.display = 'block';
            successDetail.style.display = 'none';
            errorDetail.style.display = 'none';
            statusBadge.textContent = 'Running...';
            statusBadge.className = 'badge badge-warning';

            fetch('{{ route('admin.reports.test-pdf.run') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ start: startDate, end: endDate })
            })
            .then(res => res.json())
            .then(data => {
                loadingDetail.style.display = 'none';

                document.getElementById('result-http-code').textContent = data.status_code;
                document.getElementById('result-size').textContent = data.file_size || '-';
                document.getElementById('result-time').textContent = data.generation_time;
                document.getElementById('result-products').textContent = data.num_products || '-';

                if (data.success) {
                    statusBadge.textContent = 'Success';
                    statusBadge.className = 'badge badge-success';
                    document.getElementById('result-status').textContent = '✅ Success';
                    document.getElementById('result-status').className = 'mb-0 text-success';
                    successDetail.style.display = 'block';
                    document.getElementById('success-message').textContent = data.message;

                    if (data.download_url) {
                        document.getElementById('download-link').href = data.download_url;
                    }

                    document.getElementById('preview-period').textContent =
                        startDate + ' — ' + endDate;

                    document.getElementById('result-http-code').className = 'mb-0 text-success';
                } else {
                    statusBadge.textContent = 'Failed';
                    statusBadge.className = 'badge badge-danger';
                    document.getElementById('result-status').textContent = '❌ Failed';
                    document.getElementById('result-status').className = 'mb-0 text-danger';
                    errorDetail.style.display = 'block';
                    document.getElementById('error-message').textContent = data.message;

                    if (data.error_file) {
                        document.getElementById('error-location').textContent =
                            data.error_file + ':' + data.error_line;
                    }

                    if (data.code_snippet) {
                        const pre = document.getElementById('error-code-snippet');
                        pre.innerHTML = data.code_snippet.split('\n').map(line => {
                            const isHighlighted = line.trimStart().startsWith('>>');
                            const className = isHighlighted ? 'class="line-highlight"' : '';
                            return `<span ${className}>${line}</span>`;
                        }).join('\n');
                    }

                    document.getElementById('result-http-code').className = 'mb-0 text-danger';
                }
            })
            .catch(err => {
                loadingDetail.style.display = 'none';
                errorDetail.style.display = 'block';
                successDetail.style.display = 'none';
                statusBadge.textContent = 'Error';
                statusBadge.className = 'badge badge-danger';
                document.getElementById('result-status').textContent = '❌ Error';
                document.getElementById('result-status').className = 'mb-0 text-danger';
                document.getElementById('error-message').textContent = err.message || 'Network error';
                document.getElementById('result-http-code').textContent = 'N/A';
                document.getElementById('result-http-code').className = 'mb-0 text-danger';
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-play"></i> Run Test';
            });
        }
    </script>
@endpush
