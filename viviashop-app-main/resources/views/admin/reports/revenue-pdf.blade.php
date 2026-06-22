<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #1e40af;
            font-weight: bold;
        }
        .header .subtitle {
            margin: 8px 0 3px 0;
            font-size: 13px;
            color: #666;
            font-weight: bold;
        }
        .header .meta {
            margin: 3px 0;
            font-size: 10px;
            color: #999;
        }
        .summary {
            background: #f0f9ff;
            border: 2px solid #2563eb;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 8px;
        }
        .summary h2 {
            margin: 0 0 12px 0;
            font-size: 14px;
            color: #1e40af;
            border-bottom: 1px solid #2563eb;
            padding-bottom: 5px;
        }
        .summary-grid {
            display: table;
            width: 100%;
        }
        .summary-row {
            display: table-row;
        }
        .summary-cell {
            display: table-cell;
            padding: 6px 10px;
            width: 50%;
        }
        .summary-label {
            font-weight: bold;
            color: #4b5563;
            font-size: 11px;
        }
        .summary-value {
            color: #1e40af;
            font-size: 16px;
            font-weight: bold;
            margin-top: 2px;
        }
        .summary-value.large {
            font-size: 20px;
            color: #059669;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }
        thead {
            background: #1e40af;
            color: white;
        }
        th {
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:nth-child(even) {
            background: #f9fafb;
        }
        tr:hover {
            background: #f3f4f6;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background: #dbeafe !important;
            border-top: 2px solid #2563eb;
            border-bottom: 2px solid #2563eb;
        }
        .total-row td {
            padding: 12px 8px;
            font-size: 11px;
            color: #1e40af;
        }
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 9px;
        }
        .footer p {
            margin: 3px 0;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="subtitle">Periode: {{ $period_start }} - {{ $period_end }}</div>
        <div class="meta">Dicetak pada: {{ $generated_at }}</div>
    </div>

    <!-- Summary Section -->
    <div class="summary">
        <h2>Ringkasan Revenue</h2>
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-cell">
                    <div class="summary-label">Total Revenue (Gross)</div>
                    <div class="summary-value large">Rp {{ number_format($total_revenue, 0, ',', '.') }}</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-label">Total Orders</div>
                    <div class="summary-value">{{ number_format($total_orders, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-cell">
                    <div class="summary-label">Net Revenue</div>
                    <div class="summary-value">Rp {{ number_format($net_revenue, 0, ',', '.') }}</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-label">Average per Order</div>
                    <div class="summary-value">
                        Rp {{ number_format($total_orders > 0 ? $total_revenue / $total_orders : 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-cell">
                    <div class="summary-label">Total Tax</div>
                    <div class="summary-value">Rp {{ number_format($total_tax, 0, ',', '.') }}</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-label">Total Shipping</div>
                    <div class="summary-value">Rp {{ number_format($total_shipping, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Breakdown Table -->
    @if($revenue_by_date->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 20%;">Tanggal</th>
                <th class="text-center" style="width: 15%;">Jumlah Order</th>
                <th class="text-right" style="width: 20%;">Gross Revenue</th>
                <th class="text-right" style="width: 15%;">Tax</th>
                <th class="text-right" style="width: 15%;">Shipping</th>
                <th class="text-right" style="width: 20%;">Net Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($revenue_by_date as $item)
            <tr>
                <td>{{ $item['date'] }}</td>
                <td class="text-center">{{ number_format($item['orders_count'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item['gross_revenue'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item['tax'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item['shipping'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item['net_revenue'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td><strong>TOTAL</strong></td>
                <td class="text-center"><strong>{{ number_format($total_orders, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($total_revenue, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($total_tax, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($total_shipping, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($net_revenue, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
    @else
    <div class="no-data">
        <p>Tidak ada data revenue untuk periode yang dipilih.</p>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p><strong>ViVia Shop</strong> - Laporan Revenue</p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem</p>
        <p>&copy; {{ date('Y') }} ViVia Shop. All Rights Reserved.</p>
    </div>
</body>
</html>
