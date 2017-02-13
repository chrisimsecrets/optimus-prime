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
        // Commands\prappo::class,
        // Commands\OptimusPost::class,
        Commands\ProcessTasks::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tasks:run')->everyMinute();
    }
}
