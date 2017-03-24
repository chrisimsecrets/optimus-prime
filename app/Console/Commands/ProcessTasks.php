<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Write;
use App\OptLog;
use App\User;
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

                $timezone = User::where('id', $task->userId)->value('timezone');

                $date = Carbon::createFromFormat('Y-m-d H:i', $postTime, $timezone);
                $date->setTimezone('UTC');
                $realPostTime = $date->format('Y-m-d H:i');

//                Test block start


//                Test block end

                if ($currentTime == $realPostTime) {


                    if ($task->fb == "yes") {

                        Write::fbWriteS($task->postId, $task->pageId, $task->pageToken, $task->title, $task->caption, $task->link, $task->image, $task->description, $task->content, $task->imagetype, $task->sharetype, $realPostTime);
                    }

                    if($task->fbg == "yes"){
                        Write::fbgWriteS($task->postId,$task->pageId,$task->title,$task->caption,$task->link,$task->image,$task->description,$task->content,$task->imagetype,$task->sharetype);

                    }

                    if($task->tw == "yes"){
                        Write::twWriteS($task->postId,$task->image,$task->content,$realPostTime);
                    }

                    if($task->tu == "yes"){
                        Write::tuWriteS($task->postId,$task->blogName,$task->title,$task->content,$task->image,$task->imagetype,$realPostTime);
                    }

                    if($task->wp == "yes"){
                        Write::wpWriteS($task->postId,$task->title,$task->content);
                    }

                    if($task->instagram == "yes"){
                        Write::inWriteS($task->postId,$task->image,$task->caption);
                    }


                }
            }
        }
    }
}
