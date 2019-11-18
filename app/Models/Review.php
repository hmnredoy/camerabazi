<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['posted_by', 'posted_on', 'project_id', 'rating', 'comment'];
}
