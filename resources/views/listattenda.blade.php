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
                        <div class="panel" style="margin-top:3%"><h2>Meeting Attendance List</h2></div>
                                        <hr />
                                        
                                        <div class="panel-body">
                                                        {{ csrf_field() }}
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Status</th>
                                                                    <th>Name</th>
                                                                    <th>Email Address</th>
                                                                    <th>Other address</th>
                                                                    <th>Phone number</th>
                                                                    <th>Position</th>
                                                                    <th></th>
                                                                </tr>
                                                                @foreach($attendalist as $attenda)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                        @if($attenda->status=='present')
                                                                        <label class="label label-success">{{$attenda->status}}</label>
                                                                        @else
                                                                        <label class="label label-danger">{{$attenda->status}}</label>
                                                                        @endif
                                                                      </td>
                                                                        <td>{{$attenda->fullname}} </td>
                                                                        <td>{{$attenda->email}}
                                                                        </td>
                                                                        <td>{{$attenda->phone}} </td>
                                                                        <td>{{$attenda->address}} </td>

                                                                        <td>{{$attenda->position}} </td>
                                                                        <td>  <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $attenda->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                            <i class="ti-close text-danger m-r-5"></i>Delete</a> </td>

                                                                    </tr>
                                                                </tbody>
                                                                <div class="modal fade" id="deleteSlide{!! $attenda->id !!}" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog modal-md" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                    <h4 class="modal-title" id="myModalLabel">Delete record?</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    are you sure you want to delete this record?
                                                                                   
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <span class="pull-left">

                                                                                        <form method="post" action="/attenda_delete">
                                                                                            {{ csrf_field() }}
                                                                                            <input class="form-control" type="hidden" name="attenda_id" hidden="hidden" value="{{$attenda->id}}">
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                                            <button type="submit" class="btn btn-info">Ok</button>
                                                                                        </form>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                        </div>
                                                        </div>                                          
</div>
    @endif
    </div>
    @endsection