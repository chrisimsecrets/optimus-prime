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
                $postTime = $this->carbon->parse($tasks[0]->time);
                $currentTime = $this->carbon->now();
                
                if ($postTime->lt($currentTime)) {
                    // task will run here
                }
            }
        }
    }
}
