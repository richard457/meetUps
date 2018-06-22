<?php

namespace Meet;

use Illuminate\Database\Eloquent\Model;

class responsible extends Model
{
    protected $table = 'responsible_on_agenda_details';
    protected $fillable=['agenda_details_id','member_id'];
}
