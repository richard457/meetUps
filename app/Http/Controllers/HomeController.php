<?php

namespace Meet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Meet\Meeting;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function more(Request $request){

        return view ('more');

    }

    public function index()
    {
        $meetings = Meeting::whereuser_id(Auth::id())->get();
        
        return view('home')->with('meetings',$meetings);
    }
}
