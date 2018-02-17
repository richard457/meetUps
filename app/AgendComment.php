<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class AgendComment extends Model
{
    protected $table='agendcomment';
    protected $fillable=['meeting_id','commenter','comments'];

    public function getCreatedAt($value){
        return \Carbon\Carbon::parse($value)->format('d.m.Y.');
    }
    public function agenda(){
        return $this->belongsTo("Meet\Agenda");
    }
}