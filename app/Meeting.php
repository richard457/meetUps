<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;


class Meeting extends Model
{
    protected $table='meetings';
    protected $fillable=['title','date','venue','user_id'];

    public function agenda(){
        return $this->hasMany("Meet\Agenda");
    }
    

    ///Get the user owner of meeting
    public function users()
    {
        return $this->belongsTo('Meet\User');
    }

}
