<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class AgendaDetails extends Model
{
    protected $table='agenda_details';
    protected $fillable=['matters','action','responsible','deadline','agenda_id','user_id'];

    
}