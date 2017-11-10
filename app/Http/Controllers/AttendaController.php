<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Meet\Attenda;
use Session;
class AttendaController extends Controller
{

     function store(Request $request){


        Attenda::create(
             [
                        'fullname' =>$request['fullname'],
                        'email' => $request['email'],
                        'phone' => $request['phone'],
                        'address' => $request['address'],
                        'user_id' =>$request['user_id']
             ]
           );
           Session::flash('alert-success','successfully saved.');
        return redirect()->back();

    }

    public function members()
    {
        $members = Attenda::whereuser_id(Auth::id())->get();

        return view ('members')->with ('members', $members);
    }

    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:attendants',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

    }
    function member_delete(Request $request){

        $member=Attenda::find($request->get('memberid'));
        $member->delete();
        Session::flash('alert-success','successfully Deleted.');
        return redirect()->back();
    }
    function editmembers(Request $request){
        
                $member=Attenda::find($request->get('memberid'));
                $member->fullname=$request['fullname'];
                $member->email=$request['email'];
                $member->phone=$request['phone'];
                $member->address=$request['address'];
                $member->save();
                Session::flash('alert-success','successfully Edited.');
                return redirect()->back();
            }
    
}