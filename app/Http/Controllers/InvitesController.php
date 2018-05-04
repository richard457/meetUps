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
                $invites = Invitee::whereuser_id (Auth::id ())->where('invitee_email','=', $exp[1])->where('meeting_id','=',trim($exp[2],''))->count ();
                if($invites==0){

                    Invitee::create(['meeting_id' =>trim($exp[2],''), 'user_id' => Auth::user ()->id, 'invitee_email' => $exp[1]]);
                }
               
               }

               //TODO: add send email to queue to fasten the process

                Mail::to ($exp[1])->send (new InviteMember(env('APP_DOMAIN').'/accept/invitation/' .  $exp[0].'/'.trim($exp[2],'')) );
                
               
            }else{
                return ['message'=>'invitation is not sent,try again!.'];
            }
        }
        return ['message'=>'successfully sent and saved.'];

    }

    public function acceptInvitation($meetingId)
    {
        //logic to accept invitation
        return view ('accept')->with ('meeting_id', $meetingId);
    }

   
}