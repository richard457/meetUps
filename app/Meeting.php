<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table='meetings';
    protected $fillable=['date','title','user_id'];
}
