<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookPages extends Model
{
    //
    protected $table = "facebookPages";
    protected $fillable = [
      'pageId','pageName','pageToken',  
    ];
}
