<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Meet\Attenda;

class AttendaController extends Controller
{

   protected function validator(array $data)
    {
         return Validator::make($data, [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:attendants',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
    
    }
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
        return redirect()->back();
        
    }

     public function attenda()
    {
        $attenda = Attenda::whereuser_id(Auth::id())->get();
        
      return view('attenda')->with('attenda',$attenda);
    }
}