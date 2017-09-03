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
use Meet\AgendComment;
use Meet\Mail\InviteMember;

class InvitesMeetingController extends Controller
{

    public function meetingstatement($invitingId,$meeting_id)
    {
    
       $meetings = Meeting::whereid($meeting_id)->get();
       $agenda   = Agenda::wheremeeting_id($meeting_id)->get();

       $comment = AgendComment::where('agender_id', 1)->get();
       $comment = Attenda::where('id', $invitingId)->get();
       Log:info($comment);
       

     return view ('meetingstatement')->with ('meetingstatement', $meetings)->with ('meetingAgender', $agenda)->with ('agenderComment', $comment)->with ('invitingId', $invitingId)->with ('meeting_id', $meeting_id);
   
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
