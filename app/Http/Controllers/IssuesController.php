<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Log;
use Meet\Issues;

class IssuesController extends Controller
{

     function store(Request $request){


        Issues::create(
             [          'meeting_id' => $request['meeting_id'],
                        'user_id' =>$request['user_id'],
                        'person_in_charge_name' =>$request['person_in_charge_name'],
                        'issueInDetails' => $request['issueInDetails'],

             ]
           );
        return redirect()->back();

    }

    public function issues($meetingId)
    {


        $issues = Issues::whereuser_id (Auth::id ())->wheremeeting_id ($meetingId)->get ();

        return view ('issues')->with ('issues', $issues)->with ('meeting_id', $meetingId);;
    }

    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'person_in_charge_name' => 'required|string|max:255',
            'issueInDetails' => 'required|string|max:500',
        ]);
    }
}