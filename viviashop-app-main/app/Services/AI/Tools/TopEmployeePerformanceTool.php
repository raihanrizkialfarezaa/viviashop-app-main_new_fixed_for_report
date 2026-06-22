<?php

namespace App\Services\AI\Tools;

use App\Models\EmployeeBonus;
use App\Models\EmployeePerformance;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Illuminate\Support\Facades\DB;

/**
 * UC4 — Rank employees by completed order count and transaction value.
 *
 * Uses EmployeePerformance::getMonthlyStats() for per-employee stats
 * and joins EmployeeBonus for bonus context.
 */
class TopEmployeePerformanceTool implements ToolHandler
{
    public function name(): string
    {
        return 'top_employee_performance';
    }

    public function description(): string
    {
        return 'Tampilkan peringkat performa karyawan berdasarkan jumlah order selesai dan nilai transaksi dalam rentang tanggal tertentu.';
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
                'limit' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah karyawan teratas yang ditampilkan (default 10)',
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
        $limit     = min((int) ($args['limit'] ?? 10), 50);

        if (! $startDate || ! $endDate) {
            return ToolResult::error('start_date dan end_date wajib diisi.');
        }

        try {
            // Aggregate performance per employee in date range
            $rankings = EmployeePerformance::whereBetween('completed_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                ->selectRaw('
                    employee_name,
                    COUNT(*) as total_orders,
                    SUM(transaction_value) as total_revenue,
                    AVG(transaction_value) as avg_transaction,
                    MAX(completed_at) as last_completed_at
                ')
                ->groupBy('employee_name')
                ->orderByDesc('total_revenue')
                ->limit($limit)
                ->get();

            if ($rankings->isEmpty()) {
                return ToolResult::ok(
                    ['rankings' => [], 'count' => 0],
                    '',
                    "Tidak ada data performa karyawan untuk periode {$startDate} s/d {$endDate}."
                );
            }

            // Attach bonus data for the same period
            $bonusByEmployee = EmployeeBonus::whereBetween('period_start', [$startDate, $endDate])
                ->orWhereBetween('period_end', [$startDate, $endDate])
                ->selectRaw('employee_name, SUM(bonus_amount) as total_bonus')
                ->groupBy('employee_name')
                ->pluck('total_bonus', 'employee_name');

            $data = $rankings->map(function ($row, $index) use ($bonusByEmployee) {
                $totalBonus = (float) ($bonusByEmployee[$row->employee_name] ?? 0);
                return [
                    'rank'              => $index + 1,
                    'employee_name'     => $row->employee_name,
                    'total_orders'      => (int) $row->total_orders,
                    'total_revenue'     => (float) $row->total_revenue,
                    'total_revenue_label' => 'Rp ' . number_format((float) $row->total_revenue, 0, ',', '.'),
                    'avg_transaction'   => round((float) $row->avg_transaction, 0),
                    'avg_transaction_label' => 'Rp ' . number_format((float) $row->avg_transaction, 0, ',', '.'),
                    'total_bonus'       => $totalBonus,
                    'total_bonus_label' => 'Rp ' . number_format($totalBonus, 0, ',', '.'),
                    'last_completed_at' => $row->last_completed_at,
                ];
            })->values()->all();

            $topEmployee = $data[0]['employee_name'] ?? '-';
            $topRevenue  = $data[0]['total_revenue_label'] ?? '-';

            return ToolResult::ok(
                [
                    'period'   => "{$startDate} s/d {$endDate}",
                    'rankings' => $data,
                    'count'    => count($data),
                ],
                'metric-card',
                "Top karyawan: {$topEmployee} dengan pendapatan {$topRevenue} dari " . ($data[0]['total_orders'] ?? 0) . " order."
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal mengambil data performa karyawan: ' . $e->getMessage());
        }
    }
}
