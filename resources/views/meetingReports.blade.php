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

    <!-- /////////////////////////////// where reports is begin ////////////////////////////////-->
    <div class="row">
        <button type="button" id="wordexport" class="btn btn-info">Export into word</button>
        <button type="button" class="btn btn-success" onclick='printMetting()'>Print</button>
        <br />
    </div>
    <input type="hidden" id="title" value="{{$meeting->title}} held on {{ date('F d, Y h:i:sa', strtotime($meeting->date)) }}">

    <div id="reports" style="margin-top:2%">
        <div class="row" style="background:#fff;">
            <div class="col-md-8 col-md-offset-2" style="margin-top:3%">
                <h3 style="text-transform:uppercase;text-align:center;font-weight:bold;border:solid;padding-top:0.6em;padding-bottom:0.6em;"> {{$meeting->title}} held on {{ date('F d, Y h:i:sa', strtotime($meeting->date)) }}</h3>
            </div>

            <div class="col-md-12" style="margin-top:2%">
                <ol>
                    <li style="margin-top:1%">
                        <b> Date: {{ date('F d, Y h:i:sa', strtotime($meeting->date)) }} </b>
                    </li>
                    <li style="margin-top:1%">
                        <b>Venue: @if($meeting->venue) {{$meeting->venue}} @endif</b>
                    </li>
                    @if(sizeof($present) >0)
                    <li style="margin-top:3%">
                        <b> Present in the meeting:</b>
                        <br />
                        <ol>
                            @foreach($present as $p)

                            <li style="margin-top:0.5%">
                                {{$p->fullname}} @if($p->position) ({{$p->position}}) @endif
                            </li>
                            @endforeach
                        </ol>
                    </li>
                    @endif @if(sizeof($absent) >0)
                    <li style="margin-top:2%">
                        <b> Absent in the meeting:</b>
                        <ol>
                            @foreach($absent as $a)

                            <li style="margin-top:0.5%">
                                {{$a->fullname}} @if($a->position) ({{$a->position}}) @endif
                            </li>
                            @endforeach
                        </ol>
                    </li>
                    @endif
                    <li style="margin-top:1%">
                        <b>OPENING OF THE MEETING</b>
                        <br />
                        <div class="col-md-8 col-md-offest-2"> @if($meeting->remarks) {{$meeting->remarks}} @endif</div>
                        <br />
                        <br />
                    </li>
                    <li style="margin-top:1%">
                        <b>AGENDA OF THE MEETING </b>
                        <br />
                        <b> The agenda is as follows:</b>
                        <br /> @if(sizeof($agenda) >0)
                        <ul>
                            @foreach($agenda as $agenda)

                            <li>{{$agenda->agenda}}</li>

                            @endforeach @else
                            <li>---------------------------</li>
                        </ul>
                        @endif
                    </li>

                </ol>


            </div>

            <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top:3%">
                <div class="panel panel-default">

                    @if(sizeof($agendadetails) >0)

                    <div class="panel-body">
                        <table class="table" border='1' style="width:100%">
                            <tr>
                                <th class="col-md-3">Agenda</th>
                                    <td class='col-md-9' colspan="6">
                                        <table style="width:100%;">
                                            <tr>
                                            <th class="col-md-4" style="text-align:center">Matters arising during the Meeting</th>
                                            <th class="col-md-4" style="text-align:center">Action to be taken</th>
                                            <th class="col-md-2" style="text-align:center">Responsible Person</th>
                                            <th class="col-md-2" style="text-align:center">Deadline</th>
                                            <tr>
                                        </table>
                                    </td>
                               
                            </tr>
                        
                            <form class="form-inline" id="getform" role="form" method="GET" action="{{action('BoardController@getDetails')}}">
                                {{ csrf_field() }} @foreach($agendadetails as $agenda)
                                <input type='hidden' id="agenda_id" name="agenda_id[]" value="{{$agenda->id}}">
                                          
                                <tr id="tr{{$agenda->id}}">

                                 <td class="col-md-3"  id="agenda{{$agenda->id}}">
                                        {{$agenda->agenda}}
                                    </td>
                                    <td class='col-md-9' colspan="6" style="width:100%">
                                        <table id='getdetails{{$agenda->id}}'></table>
                                    </td>





                                </tr>


                                @endforeach
                            </form>
                        </table>
                    </div>

                    @else
                    <div class="panel-body">
                        no agenda could found!
                    </div>

                    @endif
                </div>
            </div>

            <div class="col-md-12" style="margin-top:1.5%">
                <div class="col-md-8 col-md-offest-2" style="margin-top:1.5%">
                    @if($meeting->conclusion)
                    <b>Conclusion </b>
                    <br /> {{$meeting->conclusion}} @endif

                    <br />
                    <br />
                </div>
                <table border='0' style="width:100%;margin-top:1.5%;padding-bottom:20%" class="col-md-12">
                    <tr>
                        <th class="col-md-6 pull-left" style="text-align:left">Secretary
                            <br />
                            <br />
                            <br /> @if($meeting->secretor) {{$meeting->secretor}} @endif
                        </th>
                        <th class="col-md-6 pull-right" style="text-align:left">Approved and signed by:
                            <br />
                            <br />
                            <br /> @if($meeting->director) {{$meeting->director}} @endif</th>
                    </tr>

                </table>
                <br />
                <br />
            </div>

        </div>
    </div>



    @endif
</div>



@endsection