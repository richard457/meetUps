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
    protected $table='attendants';
    protected $fillable=['fullname','email','phone','address','user_id'];
}