<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table='agenda';
    protected $fillable=['title','contents','meeting_id','user_id'];
}