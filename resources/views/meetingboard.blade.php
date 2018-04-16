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

        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="body">
                    <div class="panel row clearfix">
                        <div class="panel-heading panel-info">AGENDA OF THE MEETING DETAILS </div>
                        <br /> @if(sizeof($agenda) >0)
                        <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">

                            @foreach($agenda as $agenda)
                            <div class="panel-group" id="accordion_{{$agenda->id}}" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo_{{$agenda->id}}">
                                        <h4 class="panel-title">
                                            <a class="collapsed" id="collapsed{{$agenda->id}}" role="button" data-toggle="collapse" data-parent="#accordion_{{$agenda->id}}"
                                                href="#collapseTwo_{{$agenda->id}}" aria-expanded="false" aria-controls="collapseTwo_{{$agenda->id}}">
                                                {{$agenda->agenda}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo_{{$agenda->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_{{$agenda->id}}">
                                        <div class="panel-body">

                                            <table class="col-md-12" border='1' style="width:100%">
                                                <theader>
                                                    <tr>
                                                        <td>
                                                            <center>
                                                                <wait id="wait{{$agenda->id}}" style="display:none">
                                                                    <svg class="circular" viewBox="25 25 50 50">
                                                                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                                                                    </svg>
                                                                </wait>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <th class="col-md-4">Matters arising during the Meeting</th>
                                                        <th class="col-md-3">Action to be taken</th>
                                                        <th class="col-md-2">Responsible Person</th>
                                                        <th class="col-md-2">Deadline</th>
                                                        <th class="col-md-1"></th>
                                                    </tr>
                                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                    <input type="hidden" value="{{$agenda->id}}" id="agendaid[]" class="agendaid">
                                                </theader>
                                                <tbody id="getagendadata{{$agenda->id}}">
                                                </tbody>
                                                <tfooter>
                                                   

                                                        <tr>

                                                            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
                                                            <input type="hidden" value="{{$agenda->id}}" id="agenda_id" name="agenda_id">

                                                            <td class="col-md-4">
                                                                <textarea type="text" class="col-md-12 form-control" placeholder="Enter Matters arising during the Meeting" style="overflow-y:hidden;"
                                                                    id="matter{{$agenda->id}}" name="matters"></textarea>
                                                            </td>

                                                            <td class="col-md-3">
                                                                <textarea type="text" class="col-md-12 form-control" placeholder="Enter Action to be taken" style="overflow-y:hidden;" id="action{{$agenda->id}}"
                                                                    name="action"></textarea>
                                                            </td>
                                                            <td class="col-md-2">
                                  
                                                              </td>
                                                            <td class="col-md-2">
                                                                <div class='col-md-12 input-group date' id='datepicker'>
                                                                    <input type='text' name="date" id="deadline{{$agenda->id}}" class="form-control" placeholder="Choose Deadline date" required>
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <button type="button" onclick="saveAgendaDetails({{$agenda->id}})" data-toggle="modal" data-target="#resposibleModal{!! $agenda->id !!}"
                                                                    class="col-md-12 btn btn-info">Save</button>



                                                            </td>
                                                        </tr>
                                                   
                                                    <div class="modal fade" id="resposibleModal{!!$agenda->id!!}" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                             
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">ADD RESPONSIBLE
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closable{!!$agenda->id!!}">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                        </div>
                                                                       
                                                                        <div class="panel-body">

                                                                            <div id="getmembertable{!!$agenda->id!!}">

                                                                            </div>

                                                                        </div>
                                                                        <div class="panel-footer">  

                                                                            <button class="btn btn-info" onclick="finalsaveAgendaDetails({{$agenda->id}})">Save</button>
                                                                        </div>
                                                                    </div>
                                                                    <div style="display:none">
                                                                        <input type="text" id="getmatter{{$agenda->id}}">
                                                                        <input type="text" id="getaction{{$agenda->id}}">
                                                                        <input type="text" id="getdeadline{{$agenda->id}}">
                                                                    </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>


                                                </tfooter>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        @else
                        <div class="panel-body">
                            no agenda could found!
                        </div>

                        @endif


                    </div>
                </div>
            </div>
        </div>
        <!-- .col -->
        <div class="col-md-12 col-lg-12 col-sm-12">

            <div class="panel-heading panel-info"> </div>
            <br /> @if(sizeof($agenda) >0)
            <form class="form-inline" id="_testForm" role="form" method="POST" action="{{action('MeetingController@finaldatachanger')}}">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
                <input type="hidden" value="{{$meeting->id}}" name="meetingid" id="meetingid">
                <table border='1' style="width:100%">
                    <tr>
                        <th class="col-md-3">
                            <label>Opening Remarks</label>
                        </th>
                        <th class="col-md-3">
                            <label>Conclusion</label>
                        </th>
                        <th class="col-md-2">
                            <label>Approved and signed</label>
                        </th>
                        <th class="col-md-2">
                            <label>Secretary</label>
                        </th>
                        <td class="col-md-2">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">

                            <textarea type="text" class="col-md-12" rows="8" placeholder="Enter opening meeting remarks" style="overflow-y:hidden;" id="remarks"
                                name="remarks">@if($meeting->remarks) {{$meeting->remarks}} @endif</textarea>

                        </td>
                        <td class="col-md-3">

                            <textarea type="text" class="col-md-12" rows="8" placeholder="Enter conclusion" style="overflow-y:hidden;" id="conclusion"
                                name="conclusion">@if($meeting->conclusion) {{$meeting->conclusion}} @endif</textarea>

                        </td>



                        <td class="col-md-2">

                            <textarea type="text" class="col-md-12" rows="8" placeholder="Approved and signed by" id="director" name="director">@if($meeting->director) {{$meeting->director}} @endif</textarea>

                        </td>
                        <td class="col-md-2">
                            <textarea type="text" class="col-md-12" rows="8" placeholder="Enter Secretary" id="secretary" name="secretary">@if($meeting->secretor) {{$meeting->secretor}} @endif</textarea>

                        </td>
                        <td class="col-md-2">

                            <button type="submit" class="col-md-12 btn btn-info">Save</button>

                        </td>
                    </tr>



                </table>
            </form>
            @endif
        </div>
    </div>

    @endif
</div>


@endsection