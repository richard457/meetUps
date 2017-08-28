<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Meet\Meeting;
class MeetingController extends Controller
{
    public function store(Request $request){

        Meeting::create($request->all());
        return redirect()->back();

        //bashobora kongeramo agenda ()
        //bashobora no guhindura itariki inama izabera
        //igihe kinama cyarangiye ntawahindura ikintu kunama.
        //gutanga alert mbere yinama
        //add SMS by twillio 20$ to alert people.
        //ufata minutes zinama azifata kugihe cyinama gusa kandi uwateguye inama niwe ugena ufata minutes
        //prepare link to attendees to add their own comment.
        //add flag on each meeting to show status(after some one who take the minutes agree)
        //remote edit option after the final meeting report.
        //on each deadline of agenda matter arising send the alert.(More important)
        
    }
}
