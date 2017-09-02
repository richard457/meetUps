<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Log;
use Meet\Agenda;

class AgendaController extends Controller
{

     function store(Request $request){

        Agenda::create(
             [
                'title' =>$request['title'],
                'contents' => $request['contents'],
                'meeting_id' => $request['meeting_id'],
                 'user_id' => Auth::id ()
             ]);
        return redirect()->back();

    }

    public function agenda($meeting_id)
    {
        $agenda = Agenda::whereuser_id(Auth::id())->wheremeeting_id(1)->get();
        return view ('agenda')->with ('agenda', $agenda)->with ('meeting_id', $meeting_id);
    }

    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'title' => 'required|string|max:255',
            'contents' => 'required|string|max:500',
        ]);
    }
}