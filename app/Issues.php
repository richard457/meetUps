<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $table='issues';
    protected $fillable=['meeting_id','user_id','person_in_charge_name','issueInDetails'];
}