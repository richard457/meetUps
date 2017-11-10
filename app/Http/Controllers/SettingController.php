<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Meet\User;
use Session;
use DB;
class SettingController extends Controller
{

    function setting(){
        return view('setting');  
    }

    function changesetting(Request $request){
        $findemail=User::where('email','=',$request['email'])->where('id','!=',Auth::user ()->id)->count();
        if($findemail > 0){
            Session::flash('alert-danger','User email is already taken!');
        }else{
            if($request['name']=="" || $request['email']=="" || $request['password']==""){
                Session::flash('alert-warning','Please, required field.');
            }else{
            $info=User::find(Auth::user ()->id);
            $info->name= $request['name'];
            $info->email= $request['email'];
            $info->password=  bcrypt($request['password']);
            $info->save();
            Session::flash('alert-success','User info has changed successfully.');
            }
        }
return redirect ()->back ();   
    }
}