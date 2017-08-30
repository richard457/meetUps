<?php

namespace Meet\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;
use Meet\Invitee;
use Meet\Mail\InviteMember;

class InviteByCsvFile extends Controller
{
    public function inviteByCsv(Request  $request){

        if($request->input('type') == 'csv'){
            Log::info("here man");
            $data = Excel::load($request->csv->path(), function($reader) {})->get();
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        Log::info($v);
//                        Mail::to($v['email'])->send(new InviteMember('http://localhost:8000/invited/'.$request->get('meeting_id').'/'.$request->get('meeting_owner')));
//                        $insert[] = ['email' => $v['email'], 'meeting_id' => 1, 'user_id'=>1];
                    }
                }
                if(!empty($insert)){

//                    Invitee::create($insert);
                }

            return;
        }
    }
    }
}
