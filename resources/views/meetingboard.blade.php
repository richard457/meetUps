@extends('layouts.app') @section('content')

<div class="container-fluid">

    @if(sizeof($meeting) >0)
    <div class="row bg-title">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <div class="user-img">
                <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
            </div>
        </div>

        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-5" style="margin-top:1.5%">
            <span>{{$meeting->title}}</span>
            <br />
            <span class="time">
                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F d, Y h:i:sa', strtotime($meeting->date)) }}</span>, at
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span class="text-success">{{ $meeting->venue }}</span>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="margin-top:0.6%">
            <ul class="nav navbar-top-links navbar-right pull-left">

                <li>
                    <a href="/_meeting/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Home</a>
                </li>
                <li>
                    <a href="/_meeting/agenda/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Agenda</a>
                </li>
                <li>
                    <a href="/_meeting/board/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Meeting board</a>
                </li>
                <li>
                    <a href="/_meeting/invite/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Invite</a>
                </li>
                <li class="dropdown dropdown-submenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #54667a;font-size:18px;font-weight:400">Attendance</a>
                    <ul class="dropdown-menu" style="margin-top:-67%">
                        <li>
                            <a href="/_meeting/new_attenda/{{$meeting->id}}">New Attendance</a>
                        </li>
                        <li>
                            <a href="/_meeting/list_attenda/{{$meeting->id}}">Attendance List</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="/_meeting/reports/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Reports</a>
                </li>

            </ul>
        </div>

    </div>

    <div class="row">
        <!-- .col -->
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="panel panel-default">

                <div class="panel-heading">Agenda of the meeting </div>

                @if(sizeof($agenda) >0)
                
                <div class="panel-body">
                   <div class="row" style="border:solid">
                    <div class="col-md-12" style="border-bottom:solid">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">Agenda</div>
                        <div class="col-md-3">Matters arising during the Meeting</div>
                        <div class="col-md-2">Action to be taken</div>
                        <div class="col-md-2">Responsible Person</div>
                        <div class="col-md-2">Deadline</div>
                    </div>
                    
                    <form class="form-inline" id="getform" role="form" method="GET" action="{{action('BoardController@getDetails')}}">
                                           {{ csrf_field() }}
                    @foreach($agenda as $agenda)
                    
                    <div id="tr{{$agenda->id}}" class="col-md-12" style="border-bottom:solid">
                   <div class="col-md-1">
                        <button class="col-md-12 btn btn-lg btn-default" data-toggle="modal" data-target="#addSlide{!! $agenda->id !!}" style="background:#fff;border:none"
                            type="button">
                            + </button>

                    </div>

                    <div class="col-md-2" id="agenda{{$agenda->id}}">
                     {{$agenda->agenda}}
                    </div>
                    <div class='col-md-9'> <div id='getdetails{{$agenda->id}}'></div></div>
                    <input type='hidden' id="agenda_id" name="agenda_id[]"  value="{{$agenda->id}}">
                 
               
                  

                </div>

                
                @endforeach
                </form>
            </div>
        </div>

        @else
        <div class="panel-body">
            no agenda could found!
        </div>

        @endif @if(sizeof($agenda) >0)
        <div style="margin-top:3%">

            <div class="col-md-6">
                <div class="col-md-12">
                    <label class="col-md-4">Opening Remarks</label>
                    <textarea type="text" class="col-md-8" onkeydown="autoResize(event)" placeholder="Enter opening meeting remarks" style="overflow-y:hidden;"
                        id="remarks" name="remarks"></textarea>

                </div>
                <div class="col-md-12">
                    <br />
                    <label class="col-md-4">Conclusion</label>

                    <textarea type="text" class="col-md-8" onkeydown="autoResize(event)" placeholder="Enter conclusion" style="overflow-y:hidden;"
                        id="conclusion" name="conclusion"></textarea>

                </div>

            </div>


            <div class="col-md-6">
                <div class="col-md-12">
                    <label class="col-md-4">Approved and signed</label>
                    <input type="text" class="col-md-8" placeholder="Enter Approved and signed" id="director" name="director">

                </div>
                <div class="col-md-12">
                    <br />
                    <label class="col-md-4">Secretary</label>

                    <input type="text" class="col-md-8" placeholder="Enter Secretary" id="secretary" name="secretary">

                </div>
            </div>

            <div class="col-md-12">
                <br />
                <br />
                <button type="submit" style="margin-top:-1%" class="col-md-12 btn btn-success btn-lg">Save</button>
            </div>


        </div>
        @endif
    </div>
</div>

@endif
</div>


@endsection