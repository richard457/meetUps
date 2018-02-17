<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table='members';
    protected $fillable=['fullname','email','phone','address','position','user_id'];
}