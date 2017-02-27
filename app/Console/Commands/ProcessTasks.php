<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\OptSchedul;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

class ProcessTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run scheduled tasks.';

    protected $schedule;

    protected $carbon;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule, Carbon $carbon)
    {
        $this->schedule = $schedule;

        $this->carbon = $carbon;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = OptSchedul::all();

        foreach ($tasks as $task) {
            if ($this->carbon->parse($task->time)) {
                $postTime = $task->time;
                $currentTime = $this->carbon->now()->format('Y-m-d H:i');

                if ($currentTime == $postTime) {
                    $log = new \App\Notify();
                    $log->img = "#";
                    $log->title = "Title here";
                    $log->body = "Content here";
                    $log->url = "http://google.com";
                    $log->type = "message";
                    $log->userId = "1";
                    $log->time = Carbon::now();
                    $log->save();
                }
            }
        }
    }
}
