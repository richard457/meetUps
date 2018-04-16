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
use Meet\Member;
use Redirect;
class BoardController extends Controller
{
    public function store(Request $request){
        
        $Agenda = new AgendaDetails();
        $Agenda->matters =  $request['matters'];
        $Agenda->action = $request['action'];
        $Agenda->responsible =   join(',',$request->get('responsible')); 
        $Agenda->deadline =   $request['deadline']; 
        
        $Agenda->responsible_email =   json_encode($request['responsible_email']); 
        $Agenda->responsible_id =   json_encode($request['responsible_id']); 
        
        $Agenda->agenda_id =   $request['agenda_id']; 
        $Agenda->user_id =   Auth::id ();
        $Agenda->save ();
        return ['message'=>'successfully saved.','status'=>200];   
    }

    function getDetails(Request $request){
   
            $a= AgendaDetails::whereuser_id (Auth::id ())->where('agenda_id',$request['value'])->get ();
            return ['data'=>$a];
    }
    function removeagendaitem(Request $request){
        $a=AgendaDetails::find($request->get ('id'));
        $a->delete ();
        
          return ['message'=>'successfully deleted.'];   
          
    }

    function editagendaDetails(Request $request){
        $a=AgendaDetails::find($request->get ('id'));
        $a->matters =  $request['matters'];
        $a->action = $request['action'];
        $a->responsible =   $request['responsible']; 
        $a->deadline =   $request['deadline']; 
        $a->save ();
      
        return ['message'=>'successfully edited.']; 
    }
    function getMemberOption(Request $request){
        $members = Member::whereuser_id(Auth::id())->orderby('id','desc')->get();
        //Log::info($members);
        return ['data'=>$members];
    }

    function getAllMembers(Request $request){
        $members = Member::all();
        return ['data'=>$members];
    }
  
}