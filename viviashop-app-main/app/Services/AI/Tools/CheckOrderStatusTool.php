<?php

namespace App\Services\AI\Tools;

use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use App\Models\Order;

class CheckOrderStatusTool implements ToolHandler
{
    public function name(): string
    {
        return 'check_order_status';
    }

    public function description(): string
    {
        return 'Dapatkan status pesanan terbaru dari pengguna yang sedang login (seperti pesanan baru, sedang dikirim, atau selesai).';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'limit' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah pesanan terbaru yang ingin ditampilkan (default 5)',
                ],
            ],
        ];
    }

    public function requiredRole(): string
    {
        return 'auth';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        try {
            $user = $ctx->user;
            if (!$user) {
                return ToolResult::error('Pengguna tidak terautentikasi.');
            }

            $limit = min((int) ($args['limit'] ?? 5), 20);
            $orders = Order::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            if ($orders->isEmpty()) {
                return ToolResult::ok(
                    ['orders' => [], 'count' => 0],
                    '',
                    'Anda belum memiliki riwayat pesanan saat ini.'
                );
            }

            $formatted = $orders->map(fn ($o) => [
                'id'             => $o->id,
                'code'           => $o->code,
                'status'         => $o->status,
                'payment_status' => $o->payment_status,
                'grand_total'    => $o->grand_total,
                'created_at'     => $o->created_at->format('d-m-Y H:i'),
                'detail_url'     => route('showUsersOrder', $o->id),
            ])->values()->all();

            $msg = "Berikut adalah daftar pesanan terbaru Anda:\n";
            foreach ($orders as $o) {
                $statusIndo = match ($o->status) {
                    Order::CREATED   => 'Dibuat',
                    Order::CONFIRMED => 'Dikonfirmasi',
                    Order::DELIVERED => 'Dikirim',
                    Order::COMPLETED => 'Selesai',
                    Order::CANCELLED => 'Dibatalkan',
                    default          => ucfirst($o->status),
                };
                $payStatusIndo = match ($o->payment_status) {
                    Order::PAID    => 'Lunas',
                    Order::UNPAID  => 'Belum Dibayar',
                    Order::WAITING => 'Menunggu Pembayaran',
                    default        => ucfirst($o->payment_status),
                };
                $totalFormatted = 'Rp ' . number_format($o->grand_total, 0, ',', '.');
                $msg .= "- **#{$o->code}** ({$o->created_at->format('d/m/Y')}): Status **{$statusIndo}**, Pembayaran **{$payStatusIndo}**, Total **{$totalFormatted}** [Detail Pesanan](" . route('showUsersOrder', $o->id) . ")\n";
            }

            return ToolResult::ok(
                ['orders' => $formatted, 'count' => count($formatted)],
                'order-history-card',
                $msg
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal mengecek status pesanan: ' . $e->getMessage());
        }
    }
}
