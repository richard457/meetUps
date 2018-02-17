<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Log;
use Meet\Issues;
use Session;
class IssuesController extends Controller
{

     function store(Request $request){
        $bgcolor=$this->generateRandColor();

        Issues::create(
             [          'meeting_id' => $request['meeting_id'],
                        'user_id' =>$request['user_id'],
                        'person_in_charge_name' =>$request['person_in_charge_name'],
                        'issueInDetails' => $request['issueInDetails'],
                        'backgrandcolor'=>$bgcolor

             ]
           );
           Session::flash('alert-success','successfully saved.');
        return redirect()->back();

    }

    public function issues($meetingId, $meetingtitle)
    {

        $issues = Issues::whereuser_id (Auth::id ())->wheremeeting_id ($meetingId)->get ();

        return view ('issues')->with ('issues', $issues)->with ('meeting_id', $meetingId)->with("meetingtitle", $meetingtitle);;
    }

    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'person_in_charge_name' => 'required|string|max:255',
            'issueInDetails' => 'required|string|max:500',
        ]);
    }

    function generateRandColor(){
        $color='#';
        
            $colors = array (0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F');
        
            for($i=0;$i<6;$i++){
        
                $color.=$colors[array_rand($colors)];
        
            }
                if(!($color=="#fff") || ($color=="#ffff")){
                    return $color;
                }
                 
    }

    function issue_delete(Request $request){
     
        $issue=Issues::find($request->get('issueid'));
        $issue->delete();
        Session::flash('alert-success','successfully Deleted.');
        return redirect()->back();
    }
}