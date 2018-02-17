<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Meet\Member;
use Session;
class MemberController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

    }
    function store(Request $request){
        
        
                 Member::create(
                     [
                                'fullname'=>$request['fullname'],
                                'email' => $request['email'],
                                'phone' => $request['phone'],
                                'address' => $request['address'],
                                'position' => $request['position'],
                                'user_id' =>$request['user_id']
                     ]
                   );
                   Session::flash('alert-success','successfully saved.');
                return redirect()->back();
        
            }

            public function members()
            {
                $members = Member::whereuser_id(Auth::id())->orderby('id','desc')->get();
        
                return view ('members')->with ('members', $members);
            }

            function member_delete(Request $request){
                
                        $member=Member::find($request->get('memberid'));
                        $member->delete();
                        Session::flash('alert-success','successfully Deleted.');
                        return redirect()->back();
                    }

            function editmembers(Request $request){
                
                        $member=Member::find($request->get('memberid'));
                        $member->fullname=$request['fullname'];
                        $member->email=$request['email'];
                        $member->phone=$request['phone'];
                        $member->address=$request['address'];
                        $member->position=$request['position'];
                        $member->save();
                        Session::flash('alert-success','successfully Edited.');
                        return redirect()->back();
                    }
        
}