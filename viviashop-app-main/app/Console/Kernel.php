<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Auto-fix print file storage every hour (commented for production)
        // $schedule->command('print:fix-storage')->hourly();

        // AI stock health check — notification only, no auto-writes
        // Runs daily at 08:00 WIB; add --notify to write to application log
        $schedule->command('ai:scan-critical-stock --notify')->dailyAt('08:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
