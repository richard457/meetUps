<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class Attenda extends Model
{
    protected $table='attendant';
    protected $fillable=['attend_id','status','meeting_id','user_id'];
}