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
use Meet\responsible;
use Meet\Member;
use Redirect;
use Mail;
use Meet\Mail\taskResponsibleMail;
class BoardController extends Controller
{
    public function store(Request $request){
        
        $agenda_details = new AgendaDetails();
      
        $agenda_details->matters =  $request['matters'];
        $agenda_details->action = $request['action'];
        $agenda_details->responsible =   join(',',$request->get('responsible')); 
        $agenda_details->deadline =   $request['deadline']; 
        
        $agenda_details->agenda_id =   $request['agenda_id']; 
        $agenda_details->user_id =   Auth::id ();
        if($agenda_details->save ()){

            for($i=0;$i < count($request['responsible_id']); $i++){
                $responsible= new  responsible();
                $responsible->agenda_details_id=$agenda_details->id;
                $responsible->member_id = $request['responsible_id'][$i];
      
                Mail::to ($request['responsible_email'][$i])->
                send (new taskResponsibleMail(env('APP_DOMAIN').'/comments/responsible/'.$request['responsible_id'][$i])
                 );
                 // TODO :: direct set cron tab that will send  mail after 5 day to remaid responseble
                $responsible->save ();
            }
        }
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
        return ['data'=>$members];
    }

    function getAllMembers(Request $request){
        $members =  Member::whereuser_id(Auth::id())->orderby('id','desc')->get();
        return ['data'=>$members];
    }
  
}