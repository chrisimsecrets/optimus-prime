<?php

namespace App\Console\Commands;

use App\Http\Controllers\SkypeController;
use App\Http\Controllers\Write;
use App\OptSchedul;
use Illuminate\Console\Command;

class OptimusPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimus {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is optimus prime';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('type') == 'everyMinute') {
            $schedule = OptSchedul::where('type', 'everyMinute')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }

        }
        elseif ($this->argument('type') == 'everyFiveMinutes'){
            $schedule = OptSchedul::where('type', 'everyFiveMinutes')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'everyTenMinutes'){
            $schedule = OptSchedul::where('type', 'everyTenMinutes')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'everyThirtyMinutes'){
            $schedule = OptSchedul::where('type', 'everyThirtyMinutes')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'hourly'){
            $schedule = OptSchedul::where('type', 'hourly')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'daily'){
            $schedule = OptSchedul::where('type', 'daily')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'weekly'){
            $schedule = OptSchedul::where('type', 'weekly')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'monthly'){
            $schedule = OptSchedul::where('type', 'monthly')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'quarterly'){
            $schedule = OptSchedul::where('type', 'quarterly')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'yearly'){
            $schedule = OptSchedul::where('type', 'yearly')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'fridays'){
            $schedule = OptSchedul::where('type', 'fridays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'saturdays'){
            $schedule = OptSchedul::where('type', 'saturdays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'sundays'){
            $schedule = OptSchedul::where('type', 'sundays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'mondays'){
            $schedule = OptSchedul::where('type', 'mondays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'tuesdays'){
            $schedule = OptSchedul::where('type', 'tuesdays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'wednesdays'){
            $schedule = OptSchedul::where('type', 'wednesdays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }
        elseif ($this->argument('type') == 'thursdays'){
            $schedule = OptSchedul::where('type', 'thursdays')->get();
            foreach ($schedule as $data) {
                if ($data->fb == 'yes') {
                    Write::fbWriteS($data->postId, $data->pageId, $data->pageToken, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype, $data->type);
                }
                if ($data->fbg == 'yes') {
                    Write::fbgWriteS($data->postId, $data->pageId, $data->title, $data->caption, $data->link, $data->image, $data->description, $data->content, $data->imagetype, $data->sharetype);
                }
                if ($data->tw == 'yes') {
                    Write::twWriteS($data->postId, $data->image, $data->content, $data->type);
                }
                if ($data->tu == 'yes') {
                    Write::tuWriteS($data->postId, $data->blogName, $data->title, $data->content, $data->image, $data->imagetype, $data->type);
                }
                if ($data->wp == 'yes') {
                    Write::wpWriteS($data->postId, $data->title, $data->content, $data->type);
                }
                if ($data->skype == 'yes') {
                    SkypeController::massSendS($data->postId, $data->content, $data->type);
                }

            }
        }


    }
}
