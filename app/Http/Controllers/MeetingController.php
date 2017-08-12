<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Meet\Meeting;
class MeetingController extends Controller
{
    public function store(Request $request){


        Meeting::create($request->all());
        return redirect()->back();
        
    }
}
