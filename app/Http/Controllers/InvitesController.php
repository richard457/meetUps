<?php

namespace Meet\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Log;
use Meet\Attenda;

class InvitesController extends Controller
{

    function store(Request $request)
    {

        Log::info ($request);
        // Attenda::create(
        //      [
        //                 'fullname' =>$request['fullname'],
        //                 'email' => $request['email'],
        //                 'phone' => $request['phone'],
        //                 'address' => $request['address'],
        //                 'user_id' =>$request['user_id']
        //      ]
        //    );
        return redirect ()->back ();

    }

    public function invites($meeting_id)
    {
        $invites = Attenda::whereuser_id (Auth::id ())->get ();


        return view ('invites')->with ('invites', $invites)->with('meeting_id',$meeting_id);
    }
}