<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{

    protected $table='invitees';
    protected $fillable=['meeting_id','user_id','invitee_email','accepted_invitation','invite_id'];
}