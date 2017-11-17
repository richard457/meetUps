<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Meet\Meeting;
use Meet\Member;
use Meet\Invitee;
use Log;
use DB;
class HomeController extends Controller
{
   public $tomorrow_timestamp;
   public $today_timestamp;
    public function __construct()
    {
        $this->middleware('auth');
        $this->today_timestamp =date("Y-m-d h:i:sa");
        $this->tomorrow_timestamp =(new \DateTime($this->today_timestamp))->add(new \DateInterval("P1D"))->format('Y-m-d h:i:sa');
    }

    public function more(Request $request){

        return view ('more');

    }

    public function index()
    {
        //$meetings = Meeting::whereuser_id(Auth::id())->get();
        $tmembers = $this->member_statitic();
        $upmeeting=  $this->upcomingmeeting_statitic();
        $dmeeting=  $this->dailymeeting_statitic();
        $tinvites=  $this->invites_statitic();
        return view('home')->with('today',$this->today_timestamp)->with('getDailyMeeting',$this->getDailyMeeting())->with('upcomingMeeting', $this->getUpcommingMeeting())->with ('tmembers', $tmembers)->with ('upmeeting', $upmeeting)->with ('dmeeting', $dmeeting)->with ('tinvites', $tinvites)->with ('acceptinvitation', $this->acceptedinvitation());
    }
    
    function member_statitic(){
       return Member::whereuser_id(Auth::id())->count();
        
    }

    function upcomingmeeting_statitic(){
        return Meeting::whereuser_id(Auth::id())->where('date','=',$this->tomorrow_timestamp)->orwhere('date','>',$this->tomorrow_timestamp)->count();
         
     }
     function dailymeeting_statitic(){
        return Meeting::whereuser_id(Auth::id())->where('date','=',$this->today_timestamp)->count();
         
     }
     function invites_statitic(){
        return Invitee::whereuser_id(Auth::id())->count();
         
     }

     function getUpcommingMeeting(){
       return DB::table('meetings')->join('users', 'meetings.user_id', '=', 'users.id')->where('user_id','=', Auth::id())->where('date','=',$this->tomorrow_timestamp)->orwhere('date','>',$this->tomorrow_timestamp)->orderby('date','asc')->get();
        
     }

     function getDailyMeeting(){
        return DB::table('meetings')->join('users', 'meetings.user_id', '=', 'users.id')->where('user_id','=', Auth::id())->where('date','=',$this->today_timestamp)->get();
         
      }
      
     
     public function acceptedinvitation()
     {
 
         $acceptinvitation=DB::table('invitees')
         ->join('members', 'invitees.invitee_email', '=', 'members.email')
        ->where('accepted_invitation', 1)->groupBy('invitee_email')->limit(5)->get();
         
         return $acceptinvitation; 
      }
    
}
