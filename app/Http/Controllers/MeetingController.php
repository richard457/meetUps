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
use Meet\Invitee;
use Meet\Attenda;
use Meet\AgendComment;
use Meet\Member;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
        ]);

    }
    public function store(Request $request){
        $checkmeeting=Meeting::where('title',$request->get ('title'))->where('date',$request->get ('date'))->count();
            if($checkmeeting > 0){
                Session::flash('alert-danger','This meeting has been saved.');   
            }else{
                Meeting::create($request->all());
                Session::flash('alert-success','successfully saved.');
            }
        return redirect()->back();   
    }

  
    public function meeting()
    {
        
        $meetings=DB::table('users')->join('meetings', 'meetings.user_id', '=', 'users.id')->where('user_id','=', Auth::id())->orderby('date','asc')->get();
        
        return view('meeting')->with('meetings',$meetings);
    }

   

    function meeting_delete(Request $request){
        
        $agenda=Agenda::where('meeting_id',$request->get ('meetingid'));
        $attenda=Attenda::where('meeting_id',$request->get ('meetingid'));
        $invite=Invitee::where('meeting_id',$request->get ('meetingid'));
        if($agenda->count()  > 0){  foreach($agenda->get() as $a){ $a->delete(); } }
        if($attenda->count()  > 0){  foreach($attenda->get() as $a){ $a->delete(); } }
        if($invite->count()  > 0){  foreach($invite->get() as $i){ $i->delete(); } }
       
        $metting=Meeting::find($request->get ('meetingid'));
        $metting->delete();
        Session::flash('alert-success','successfully Deleted.');
        return redirect()->back();
    }

    function editmeeting(Request $request){
       
        $metting=Meeting::find($request->get ('meetingid'));
        $metting->title=$request['title'];
        $metting->date=$request['date'];
        $metting->venue=$request['venue'];
        $metting->save();
        Session::flash('alert-success','successfully Edited.');
        return redirect()->back();
    }

    function finaldatachanger(Request $request){
 
        $metting=Meeting::find($request->get ('meetingid'));
        $metting->conclusion=$request['conclusion'];
        $metting->director=$request['director'];
        $metting->secretor=$request['secretary'];
        $metting->remarks=$request['remarks'];
        $metting->save();
        return ['message'=>'successfully saved!'];
        }

    function meetingDetails($meeting_id){
        $comments=$this->getComments($meeting_id);
        $meeting=$this->getMeeting($meeting_id);
        return view('meetingdetails')->with('meeting',$meeting)->with('comments',$comments);
    }

    function meetingReports($meeting_id){
        $meeting=$this->getMeeting($meeting_id);
        $agenda=$this->getAgenda($meeting_id);
        $present=$this->list_attenda($meeting_id,'present');
        $absent=$this->list_attenda($meeting_id,'absent');
        return view('meetingReports')->with('meeting',$meeting)->with('agenda',$agenda)->with('agendadetails',$agenda)->with('present',$present)->with('absent',$absent);
        
    }

    function list_attenda($meeting_id,$status){
        $attenda=DB::table('members')
        ->join('attendant', 'attendant.attend_id', '=', 'members.id')
        ->where('meeting_id','=', $meeting_id)->wherestatus($status)->orderby('status','desc')->get();
        return $attenda;
    }
    function board($meeting_id){
        $meeting=$this->getMeeting($meeting_id);
        $agenda =$this->getAgenda($meeting_id);
        return view('meetingboard')->with('meeting',$meeting)->with('agenda',$agenda);
    }
    function getAgenda($meeting_id){
        return Agenda::whereuser_id(Auth::id())->wheremeeting_id($meeting_id)->orderby('id','desc')->get();
    }
    function getMeeting($meeting_id){
        return Meeting::where('id',$meeting_id)->first();
    }
   
    public function agenda($meeting_id)
    {
        $meeting=$this->getMeeting($meeting_id);
        $agenda =$this->getAgenda($meeting_id);
        return view ('agenda')->with ('agenda', $agenda)->with('meeting',$meeting);
    }

    function addAgenda(Request $request){
      
        $agenda=new Agenda;
        $agenda->agenda    =$request['agenda'];
        $agenda->meeting_id=$request['meeting_id'];
        $agenda->user_id   = Auth::id ();
        $agenda->save();
        Session::flash('alert-success','successfully saved.');
         return redirect()->back();
        
            }

            function agenda_delete(Request $request){
                
                $agenda=Agenda::find($request->get('agendaid'));
                $agenda->delete();
                Session::flash('alert-success','successfully Deleted.');
                return redirect()->back();
            }  
            
            function editagenda(Request $request){

                $agenda=Agenda::find($request->get('agendaid'));
                $agenda->agenda=$request['agenda'];
                $agenda->save();
                Session::flash('alert-success','successfully Edited.');
                return redirect()->back();
            }

           
    

            public function invites($meeting_id)
            {
        
        
                $invites = Member::whereuser_id (Auth::id ())->get ();
        
                $meeting=$this->getMeeting($meeting_id);
                return view ('invites')->with ('invites', $invites)->with ('acceptinvitation',$this->appendOrAppend($meeting_id,1))->with ('appendinginvitation',$this->appendOrAppend($meeting_id,0))->with('meeting',$meeting);
            }
        
            public function appendOrAppend($meeting_id,$key)
            {
                $acceptinvitation=DB::table('invitees')
                ->join('meetings', 'invitees.meeting_id', '=', 'meetings.id')
                ->join('members', 'invitees.invitee_email', '=', 'members.email')
                ->where('meeting_id','=', $meeting_id)->where('accepted_invitation', $key)->groupBy('invitee_email')->get();
                
                return $acceptinvitation; 
             }

             function getComments($meeting_id){
                return  DB::table('members')
                ->join('agendcomment', 'members.id', '=', 'agendcomment.commenter')
                ->where('meeting_id', $meeting_id)
                ->get();
            }
        
            function comment_delete(Request $request){
                $comment=AgendComment::find($request->get('commentid'));
                $comment->delete();
                Session::flash('alert-success','successfully Deleted.');
                return redirect()->back();
            }

           
}


