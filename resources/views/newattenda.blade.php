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
        
                    <li><a href="/_meeting/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Home</a></li>
                    <li><a href="/_meeting/agenda/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Agenda</a></li>
                    <li><a href="/_meeting/board/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Meeting board</a></li>
                    <li><a href="/_meeting/invite/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Invite</a></li>
                    <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #54667a;font-size:18px;font-weight:400">Attendance</a>
                    <ul class="dropdown-menu" style="margin-top:-67%">
                            <li><a href="/_meeting/new_attenda/{{$meeting->id}}">New Attendance</a></li>
                            <li><a href="/_meeting/list_attenda/{{$meeting->id}}">Attendance List</a></li>
                                                            
                        </ul>
                    </li>
                    <li><a href="/_meeting/reports/{{$meeting->id}}" style="color: #54667a;font-size:18px;font-weight:400">Reports</a></li>
                    
            </ul>
        </div>

    </div>

                        <div class="col-lg-8 col-sm-8 col-md-8 col-lg-offset-2 col-md-offset-2 col-xs-6" style="background:#fff;margin-top:0.6%">
                                   
                        <div class="panel panel-info">
                                        <div class="panel" style="margin-top:3%"><h2>New Attantance</h2></div>
                                        <hr />
                                        <div class="panel-body">
                                    <form class="form-inline" id="testForm" role="form" method="POST" action="{{action('AttendaController@store')}}">
                                                        <button type="submit" class="col-md-12 btn btn-info btn-material-pink btn-raised">Save
                                                        </button>

                                                        {{ csrf_field() }}
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Select</th>
                                                                    <th>Name</th>
                                                                    <th>Email Address</th>
                                                                    <th>Other address</th>
                                                                    <th>Phone number</th>
                                                                    <th>Position</th>
                                                                </tr>
                                                                @foreach($attenda as $attenda)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                        <select name="check[]">
                                                                        <option>choose option</option><option>present</option><option>absent</option>
                                                                        </select>
                                                                            <input type='hidden' name="attendid[]" value="{{$attenda->id}}">
                                                                            <input type='hidden' name="meeting" value="{{$meeting->id}}">
                                                                        </td>
                                                                        <td>{{$attenda->fullname}} </td>
                                                                        <td>{{$attenda->email}}
                                                                        </td>
                                                                        <td>{{$attenda->phone}} </td>
                                                                        <td>{{$attenda->address}} </td>

                                                                        <td>{{$attenda->position}} </td>

                                                                    </tr>
                                                                </tbody>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </form>
                                                    </div>
                                                    </div>
</div>
    @endif
    </div>
    @endsection