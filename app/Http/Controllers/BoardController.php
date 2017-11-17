<?php
namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Meet\Meeting;
use Meet\User;
use Session;
use DB;
use Meet\AgendaDetails;
class BoardController extends Controller
{
    public function store(Request $request){
        $Agenda = new AgendaDetails();
        $Agenda->matters =  $request['matters'];
        $Agenda->action = $request['action'];
        $Agenda->responsible =   $request['responsible']; 
        $Agenda->deadline =   $request['deadline']; 
        $Agenda->agenda_id =   $request['agenda_id']; 
        $Agenda->user_id =   Auth::id ();
        $Agenda->save ();
      
        return ['message'=>'successfully saved.'];   
    }

    function getDetails(Request $request){
            $a= AgendaDetails::whereuser_id (Auth::id ())->where('agenda_id',$request['value'])->get ();
            return ['data'=>$a];
    }


  
}