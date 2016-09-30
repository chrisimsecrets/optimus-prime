<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlackBot extends Model
{
    protected $fillable = ['question', 'answer', 'channel', 'accuracy'];
}
