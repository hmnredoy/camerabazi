<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends AppModel
{
    protected $fillable = ['user_id', 'institute', 'title_or_country',  'started_at', 'ended_at', 'description', 'type'];
}
