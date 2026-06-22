<?php

namespace App\Services\AI\Tools;

use App\Models\Order;
use App\Models\Pengeluaran;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Illuminate\Support\Facades\DB;

/**
 * UC4 — Aggregate business metrics for a date range.
 *
 * Queries:
 *  - SUM(pengeluarans.nominal) for operational expenses
 *  - SUM/COUNT of completed+paid orders for revenue context
 *
 * Uses the same ≤31-day guard as ReportController to prevent
 * unbounded queries.
 */
class AggregateBusinessMetricsTool implements ToolHandler
{
    public function name(): string
    {
        return 'aggregate_business_metrics';
    }

    public function description(): string
    {
        return 'Hitung total pengeluaran operasional dan ringkasan pendapatan dalam rentang tanggal tertentu (maksimal 31 hari).';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'start_date' => [
                    'type'        => 'string',
                    'description' => 'Tanggal mulai format YYYY-MM-DD',
                ],
                'end_date' => [
                    'type'        => 'string',
                    'description' => 'Tanggal akhir format YYYY-MM-DD',
                ],
            ],
            'required' => ['start_date', 'end_date'],
        ];
    }

    public function requiredRole(): string
    {
        return 'admin';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        $startDate = $args['start_date'] ?? '';
        $endDate   = $args['end_date'] ?? '';

        if (! $startDate || ! $endDate) {
            return ToolResult::error('start_date dan end_date wajib diisi.');
        }

        // Validate date format
        try {
            $start = new \DateTime($startDate);
            $end   = new \DateTime($endDate);
        } catch (\Exception $e) {
            return ToolResult::error('Format tanggal tidak valid. Gunakan YYYY-MM-DD.');
        }

        if ($end < $start) {
            return ToolResult::error('end_date harus lebih besar atau sama dengan start_date.');
        }

        $diff = $end->diff($start)->days;
        if ($diff > 31) {
            return ToolResult::error('Rentang tanggal maksimal 31 hari.');
        }

        try {
            // Operational expenses
            $totalPengeluaran = Pengeluaran::whereBetween(
                DB::raw('DATE(created_at)'),
                [$startDate, $endDate]
            )->sum('nominal');

            // Revenue from completed+paid orders
            $revenueData = Order::where('status', Order::COMPLETED)
                ->where('payment_status', Order::PAID)
                ->whereBetween(DB::raw('DATE(order_date)'), [$startDate, $endDate])
                ->selectRaw('
                    COUNT(*) as order_count,
                    COALESCE(SUM(grand_total), 0) as gross_revenue,
                    COALESCE(SUM(shipping_cost), 0) as total_shipping,
                    COALESCE(SUM(discount_amount), 0) as total_discount
                ')
                ->first();

            $grossRevenue    = (float) ($revenueData->gross_revenue ?? 0);
            $totalShipping   = (float) ($revenueData->total_shipping ?? 0);
            $totalDiscount   = (float) ($revenueData->total_discount ?? 0);
            $orderCount      = (int) ($revenueData->order_count ?? 0);
            $netRevenue      = $grossRevenue - $totalShipping - $totalDiscount;
            $profit          = $netRevenue - (float) $totalPengeluaran;

            return ToolResult::ok(
                [
                    'period'                  => "{$startDate} s/d {$endDate}",
                    'days'                    => $diff + 1,
                    'total_pengeluaran'       => (float) $totalPengeluaran,
                    'total_pengeluaran_label' => 'Rp ' . number_format((float) $totalPengeluaran, 0, ',', '.'),
                    'order_count'             => $orderCount,
                    'gross_revenue'           => $grossRevenue,
                    'gross_revenue_label'     => 'Rp ' . number_format($grossRevenue, 0, ',', '.'),
                    'net_revenue'             => $netRevenue,
                    'net_revenue_label'       => 'Rp ' . number_format($netRevenue, 0, ',', '.'),
                    'estimated_profit'        => $profit,
                    'estimated_profit_label'  => 'Rp ' . number_format($profit, 0, ',', '.'),
                ],
                'metric-card',
                "Periode {$startDate} s/d {$endDate}: Pengeluaran Rp " . number_format((float) $totalPengeluaran, 0, ',', '.') .
                ", Pendapatan Bersih Rp " . number_format($netRevenue, 0, ',', '.') .
                ", Estimasi Profit Rp " . number_format($profit, 0, ',', '.') .
                " dari {$orderCount} order."
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal mengambil data metrik bisnis: ' . $e->getMessage());
        }
    }
}
