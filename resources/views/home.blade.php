@extends('layouts.app')

@section('content')

<div class="container" style="padding:1em;">

    <div class="row">
    <div class="col-md-12" style="margin-left:-185px;">
    <div class='pull-left'><a href='/attenda' class="btn btn-primary">Attendants info</a></div>
    </div>
   
        <div class="col-md-6" style="margin-left:-185px;">
        
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard </div>

                <div class="panel-body">
                    <form method="post" action="meeting">
                        {{ csrf_field() }}
                        <input class="form-control" name="title" placeholder="title of the meeting"><br>
                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id" ><br>
                        <input class="form-control" name="date" type="date"><br>
                        <button type="submit" class="btn btn-info btn-lg">Schedule Meeting</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-7" style="min-width:750px;" @if(sizeof($meetings) >0)>
        
        @foreach($meetings as $meet) 
            <li style="padding:1em;display:block;background:#fff;margin-bottom:10px;">
           <span id="meetting"> {{$meet->title}} </span>
            <a href="/agenda/{{$meet->id}}" class="btn btn-info btn-sm pull-right" style="margin-right:1em;">agenda..</a>
             <a href="/issues/{{$meet->id}}" class="btn btn-info btn-sm pull-right" style="margin-right:1em;">issues..</a>
              <a href="/invites/{{$meet->id}}" class="btn btn-info btn-sm pull-right" style="margin-right:1em;">inviting..</a>
            <a href="#" onclick="printMetting()" class="btn btn-info btn-sm pull-right" style="margin-right:1em;">Print</a>
           
            </li>
        @endforeach
    
        </div @endif>
    </div>
</div>
@endsection

<script>

function printMetting(){
var print       = document.getElementById('meetting').innerHTML;
var currentFile = document.body.innerHTML;
document.body.innerHTML     =print;
window.print();
document.body.innerHTML=currentFile;

}

</script>