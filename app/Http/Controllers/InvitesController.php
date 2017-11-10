<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Mail;
use Meet\Attenda;
use Meet\Http\Requests;
use Meet\Invitee;
use Meet\Mail\InviteMember;
use Session;
use DB;
class InvitesController extends Controller
{

    function store(Request $request)
    {

        foreach ($request->get ('check') as $key => $val) {
            if (!empty($val)) {
                $exp = explode (',', $val);
               if (!empty($exp)) {
                
                 Invitee::create(['meeting_id' =>trim($exp[2],''), 'user_id' => Auth::user ()->id, 'invitee_email' => $exp[1]]);
               }

                Mail::to ($exp[1])->send (new InviteMember('http://localhost:8000/accept/invitation/' .  $exp[0].'/'.trim($exp[2],'')) );
            }
        }
        Session::flash('alert-success','successfully sent and saved.');
        return redirect ()->back ();

    }

    public function acceptInvitation($meetingId)
    {
        //logic to accept invitation
        return view ('accept')->with ('meeting_id', $meetingId);
    }

    public function invites($meeting_id,$meetingtitle)
    {


        $invites = Attenda::whereuser_id (Auth::id ())->get ();


        return view ('invites')->with ('invites', $invites)->with ('meeting_id', $meeting_id)->with("meetingtitle", $meetingtitle)->with ('acceptinvitation',$this->appendOrAppend($meeting_id,1))->with ('appendinginvitation',$this->appendOrAppend($meeting_id,0));
    }

    public function appendOrAppend($meeting_id,$key)
    {

        $acceptinvitation=DB::table('invitees')
        ->join('meetings', 'invitees.meeting_id', '=', 'meetings.id')
        ->join('attendants', 'invitees.invitee_email', '=', 'attendants.email')
        ->where('meeting_id','=', $meeting_id)->where('accepted_invitation', $key)->groupBy('invitee_email')->get();
        
        Log::info($acceptinvitation);
        return $acceptinvitation; 
     }

     

    
}