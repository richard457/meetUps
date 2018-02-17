<?php
namespace Meet\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Log;
use Meet\Agenda;
use Meet\AgendComment;
use Session;
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
             Session::flash('alert-success','successfully saved.');
        return redirect()->back();

    }

    public function agenda($meeting_id,$meetingtitle)
    {
        $agenda = Agenda::whereuser_id(Auth::id())->wheremeeting_id($meeting_id)->orderby('id','desc')->get();
        return view ('agenda')->with ('agenda', $agenda)->with ('meeting_id', $meeting_id)->with("meetingtitle", $meetingtitle);
    }

    protected function validator(array $data)
    {
        return Validator::make ($data, [
            'title' => 'required|string|max:255',
            'contents' => 'required|string|max:500',
        ]);
    }

    function agenda_delete(Request $request){
        
               $agendacmt=AgendComment::where('agender_id',$request->get ('agendaid'));
                        if($agendacmt->count()){

                            foreach($agendacmt->get() as $acmt){
                                $acmt->delete();
                            }
                        }
            
           
        $agenda=Agenda::find($request->get('agendaid'));
        $agenda->delete();
        Session::flash('alert-success','successfully Deleted.');
        return redirect()->back();
    }
    function editagenda(Request $request){
        $agenda=Agenda::find($request->get('agendaid'));
        $agenda->title=$request['title'];
        $agenda->contents=$request['contents'];
        $agenda->save();
        Session::flash('alert-success','successfully Edited.');
        return redirect()->back();
    }

    
}