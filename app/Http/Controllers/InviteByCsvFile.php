<?php

namespace Meet\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;
use Meet\Invitee;
use Meet\Mail\InviteMember;

class InviteByCsvFile extends Controller
{
    public function inviteByCsv(Request  $request){

        if($request->input('type') == 'csv'){

            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){
                Log::info('I am here');
                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        Mail::to($v['invitee_email'])->send(new InviteMember('http://localhost:8000/invited/'.$request->get('meeting_id').'/'.$request->get('meeting_owner')));
                        $insert[] = ['email' => $v['invitee_email'], 'phone' => $v['meeting_id'], 'user_id'=>Auth::user()->id];


                    }
                }
                if(!empty($insert)){

                    Invitee::create($insert);
                }

            return;
        }
    }
    }
}
