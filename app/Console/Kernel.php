<?php

namespace App\Console;

use App\Http\Controllers\Data;
use App\Http\Controllers\SkypeController;
use App\Http\Controllers\Write;
use App\OptSchedul;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\prappo::class,
        Commands\OptimusPost::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('inspire')
//                 ->hourly();
        $schedule->command('optimus everyMinute')->everyMinute();

        $schedule->command('optimus everyFiveMinutes')->everyFiveMinutes();

        $schedule->command('optimus everyTenMinutes')->everyTenMinutes();

        $schedule->command('optimus everyThirtyMinutes')->everyThirtyMinutes();

        $schedule->command('optimus hourly')->hourly();

        $schedule->command('optimus daily')->daily();

        $schedule->command('optimus weekly')->weekly();
        
        $schedule->command('optimus monthly')->monthly();

        $schedule->command('optimus quarterly')->quarterly();

        $schedule->command('optimus yearly')->yearly();

        $schedule->command('optimus fridays')->fridays();

        $schedule->command('optimus saturdays')->saturdays();

        $schedule->command('optimus sundays')->sundays();

        $schedule->command('optimus mondays')->mondays();

        $schedule->command('optimus tuesdays')->tuesdays();

        $schedule->command('optimus wednesdays')->wednesdays();

        $schedule->command('optimus thursdays')->thursdays();


    }
}
