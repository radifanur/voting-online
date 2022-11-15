<?php

namespace App\Console;

use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Notif::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $periode = Periode::first();
        $hari = Carbon::parse($periode->akhir)->format('d');
        $jam = Carbon::parse($periode->akhir)->format('H:i');
        // Notif Berakhir
        $schedule->command('notif:periode')->monthlyOn($hari, $jam);

        // Reminder Sebelum Berakhir
        $jamReminder = Carbon::parse($periode->akhir)->subHours(2)->format('H:i');
        $schedule->command('reminder:pemilu')->monthlyOn($hari, $jamReminder);
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
