<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Log;
class MeetingController extends Controller
{
    public function store(Request $request){
        // get this by vujs
         \Meet\Meeting::create($request->all());
        return redirect()->back();
        
    }
}
