<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Meet\Meeting;
use Meet\User;
use Session;
use DB;
use Meet\Agenda;
use Meet\AgendComment;

class MeetingController extends Controller
{
    public function store(Request $request){

        Meeting::create($request->all());
        Session::flash('alert-success','successfully saved.');
        return redirect()->back();

        //bashobora kongeramo agenda (ok)
        //bashobora no guhindura itariki inama izabera (ok)
        //igihe kinama cyarangiye ntawahindura ikintu kunama.
        //gutanga alert mbere yinama
        //add SMS by twillio 20$ to alert people.
        //ufata minutes zinama azifata kugihe cyinama gusa kandi uwateguye inama niwe ugena ufata minutes
        //prepare link to attendees to add their own comment.
        //add flag on each meeting to show status(after some one who take the minutes agree)
        //remote edit option after the final meeting report.
        //on each deadline of agenda matter arising send the alert.(More important)
        
    }

  
    public function meeting()
    {
        //$meetings = Meeting::whereuser_id(Auth::id())->get();
        //$meetings = User::find(Auth::id())->meetings()->orderBy('id')->get();
        $meetings=DB::table('users')->join('meetings', 'meetings.user_id', '=', 'users.id')->where('user_id','=', Auth::id())->orderby('date','asc')->get();
        
        return view('meeting')->with('meetings',$meetings);
    }

    function meeting_delete(Request $request){
        
        $agenda=Agenda::where('meeting_id',$request->get ('meetingid'));
      
        if($agenda->count()  > 0){

            foreach($agenda->get() as $a){

                     $agendacmt=AgendComment::where('agender_id',$a->id);
                        if($agendacmt->count()){

                            foreach($agendacmt->get() as $acmt){
                                $acmt->delete();
                            }
                        }
               
                $a->delete();
            }
            
    
        }
       
        $metting=Meeting::find($request->get ('meetingid'));
        $metting->delete();
        Session::flash('alert-success','successfully Deleted.');
        return redirect()->back();
    }

    function editmeeting(Request $request){
        $metting=Meeting::find($request->get ('meetingid'));
        $metting->title=$request['title'];
        $metting->date=$request['date'];
        $metting->save();
        Session::flash('alert-success','successfully Edited.');
        return redirect()->back();
    }

}


