<?php

namespace App\Console;

use App\Models\LeaveQuotas;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $checkMonth = LeaveQuotas::where('year', 'like', Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->format('Y'));

        if ($checkMonth->exists()) {
            if ($checkMonth->count() < Member::pluck('id')->count()) {
                $schedule->command('AddMemberLeaveQuota:name')->monthly();
            }

            return $schedule->command('CreateLeaveQuota:name')->everyMinute();
        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
