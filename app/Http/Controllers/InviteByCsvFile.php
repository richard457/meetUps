<?php

namespace Meet\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;
use Meet\Attenda;
use Meet\Invitee;
use Meet\Mail\InviteMember;

class InviteByCsvFile extends Controller
{
    public function inviteByCsv(Request  $request){

        if($request->input('type') == 'csv'){

            $data = Excel::load($request->csv->path(), function($reader) {})->get();
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        $attend = new Attenda();
                        $attend->email = $v['email'];
                        $attend->phone = $v['phone'];
                        $attend->fullname = $v['name'];
                        $attend->user_id = Auth::id ();
                        $attend->address = $v['address'];
                        $attend->save ();
                        Mail::to ($v['email'])->send (new InviteMember('http://localhost:8000/accept/invitation/' . $request->get ('meeting_id') . '/' . $request->get ('meeting_owner')));
                    }
                }

                return redirect ()->back ();
        }
    }
    }
}
