<?php

namespace Meet\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Meet\Http\Requests ;
use Log;
use Meet\Attenda;
use Mail;
use Meet\Invitee;
use Meet\Mail\InviteMember;

class InvitesController extends Controller
{

    function store(Request $request)
    {
        Log:info($request->All());
        foreach($request->get('check') as $key => $val){
           if(!empty($val)){
             $exp=explode(',',$val);

               Mail::to($exp[1])->send(new InviteMember('<a href="http://localhost:8000/invited/2/'.$exp[0].'"></a>'));
               $insert[] = ['meeting_id' => 2,'user_id'=>Auth::user()->id,'invitee_email' => $exp[1]];


           }
        }

         if(!empty($insert)){

                    Invitee::create($insert);
                }
        return redirect ()->back ();

    }

    public function invites($meeting_id)
    {

        $invites = Attenda::whereuser_id (Auth::id ())->get ();


        return view ('invites')->with ('invites', $invites)->with('meeting_id',$meeting_id);
    }
}