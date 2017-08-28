<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
    protected $fillable =['invitee_email','meeting_id','accepted_invitation'];
}
