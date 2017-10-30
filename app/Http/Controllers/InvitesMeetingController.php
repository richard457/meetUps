<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Mail;
use Meet\Attenda;
use Meet\Http\Requests;
use Meet\Meeting;
use Meet\Agenda;
use Meet\Invitee;
use Meet\AgendComment;
use Meet\Mail\InviteMember;
use DB;
class InvitesMeetingController extends Controller
{


    public function acceptInvitation($invitingId,$meeting_id)
    {

     return view ('acceptInvitation')->with ('invitingId', $invitingId)->with ('meeting_id', $meeting_id);
   
    }
    
    public function accepted(Request $request)
    {
        $member_email = Attenda::whereid($request->get('invitingId'))->first()->email;
         $Invitee =  Invitee::wheremeeting_id($request->get('meeting_id'))->where('invitee_email',$member_email)->where('accepted_invitation',0)->first();
                        $Invitee->accepted_invitation =true;
                        $Invitee->save ();
                  return redirect()->to('/meeting/agenda/'.$request->get('invitingId').'/'.$request->get('meeting_id'));
                  
            
    
    }

    public function meetingstatement($invitingId,$meeting_id)
    {
    
       $meetings = Meeting::whereid($meeting_id)->get();
       $agenda   = Agenda::wheremeeting_id($meeting_id)->get();
     
     return view ('meetingstatement')->with ('meetingstatement', $meetings)->with ('meetingAgender', $agenda)->with ('invitingId', $invitingId)->with ('meeting_id', $meeting_id);
   
    }
    public function singleAgenda($id,$invitedId,$agendatitle){
       // $comment = AgendComment::where('agender_id', $id)->get();
        $comment =  DB::table('attendants')
        ->join('agendcomment', 'attendants.id', '=', 'agendcomment.commenter')
        ->where('agender_id', $id)
        ->get();
        return view ('agendaComment')->with ('agendaComment', $comment)->with ('agendaid', $id)->with ('invitingId', $invitedId)->with('agendatitle',$agendatitle);
    }

     public function store(Request $request)
    {
    
         $AgendComment = new AgendComment();
                        $AgendComment->agender_id =  $request['agenda'];
                        $AgendComment->commenter = $request['commenter'];
                        $AgendComment->comments =   $request['comment']; 
                        $AgendComment->save ();
                  return redirect()->back();
                  
            
    
    }
     

    
}
