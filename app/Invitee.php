<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{

    protected $fillable = ['meeting_id', 'user_id', 'invitee_email'];
    protected $table = 'invitees';
}

