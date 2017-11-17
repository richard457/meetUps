<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Meet\Member;
use Meet\Attenda;
use Meet\Meeting;
use Session;
use Log;
use DB;
class AttendaController extends Controller
{

     function store(Request $request){
         for($i=0;$i<count($request->get ('check')) ;$i++){
             if($request->get ('check')[$i]=="present" || $request->get ('check')[$i]=="absent"){
                $att = Attenda::whereuser_id (Auth::id ())->where('attend_id','=', $request->get ('attendid')[$i])->where('meeting_id','=',$request->get ('meeting'))->count ();
                if($att==0){
                $attenda = new Attenda();
                $attenda->attend_id  = $request->get ('attendid')[$i];
                $attenda->status     = $request->get ('check')[$i];
                $attenda->meeting_id = $request->get ('meeting'); 
                $attenda->user_id =Auth::id (); 
                
                $attenda->save ();
                }else{
                    $msg= ['message'=>'1 member has been attended on this meeting.'];
                }
             }
           
         }
         $msg= ['message'=>'successfully saved.'];
         return $msg;
    }

function list_attenda($meeting_id){
    $meeting=Meeting::where('id',$meeting_id)->first();
    //$attenda = Member::whereuser_id (Auth::id ())->get ();
    $attenda=DB::table('members')
    ->join('attendant', 'attendant.attend_id', '=', 'members.id')
    ->where('meeting_id','=', $meeting_id)->orderby('status','desc')->get();
    return view ('listattenda')->with ('attendalist', $attenda)->with('meeting',$meeting);
}

function new_attenda($meeting_id){
    $meeting=Meeting::where('id',$meeting_id)->first();
    $attenda = Member::whereuser_id (Auth::id ())->get ();

    return view ('newattenda')->with ('attenda', $attenda)->with('meeting',$meeting);
}

function deleteAttenda(Request $request){
    $comment=Attenda::find($request->get('attenda_id'));
    $comment->delete();
    Session::flash('alert-success','successfully Deleted.');
    return redirect()->back();
}


    
}