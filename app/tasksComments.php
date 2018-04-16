<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;

class tasksComments extends Model
{
    
    protected $table = 'tasks_comments';
    protected $fillable=['commentor_id','comments','agenda_details_id'];
}
