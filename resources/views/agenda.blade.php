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




    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </p>
        @endif @endforeach
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:125px">
            <div class="panel panel-default">
                <div class="panel-heading">Agenda of Meeting</div>

                <div class="panel-body">

                    <form method="post" action="/agenda">
                        {{ csrf_field() }}
                      
                        <input class="form-control" type="hidden" name="meeting_id" value="{{$meeting->id}}">

                        <div class="form-group">
                            <label for="agenda" class="col-md-2 control-label">Agenda item</label>

                            <div class="col-md-8">
                                <input id="agenda" type="text" placeholder="add agenda item" class="form-control" name="agenda" required autofocus>
                             
                            </div>
                        </div>

                        <button type="submit" style="margin-top:-1%" class="col-md-2 btn btn-info btn-lg">Save</button>
                    </form>

                </div>
            </div>
        </div>

      


        <div class="row">
            <!-- .col -->
            <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                @if(sizeof($agenda) >0)
                <div class="white-box">
                    <div class="panel panel-default">
                        <div class="panel-heading">View All Agenda</div>
                        <div class="panel-body">
                            @foreach($agenda as $agenda)
                            <div class="comment-center p-t-10">
                                <div class="comment-body">
                                    <div class="user-img">
                                        <img src="{{ asset('images/agenda.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>{{$agenda->agenda}}</h5>
                                        <span class="time">{{ date('F d, Y', strtotime($agenda->created_at)) }}</span>
                                
                                        <span class="pull-right">
                                            <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $agenda->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                                <i class="ti-close text-danger m-r-5"></i>Delete</a>
                                            <a href="#" data-toggle="modal" data-target="#editSlide{!! $agenda->id !!}" class="btn-rounded btn btn-primary btn-outline">
                                                <i class="ti-close text-primary m-r-5"></i>Edit</a>
                                        </span>
                                    </div>
                                </div>


                            </div>
                            <div class="modal fade" id="editSlide{!! $agenda->id !!}" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">


                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Edit agenda item</h4>
                                        </div>

                                        <div class="panel-body">

                                        <form method="post" action="/editagenda">
                                                {{ csrf_field() }}
                                            
                                                <input class="form-control" type="hidden" name="meeting_id" value="{{$meeting->id}}">

                                                <div class="form-group">
                                                    <label for="agenda" class="col-md-2 control-label">Agenda item</label>

                                                    <div class="col-md-8">
                                                        <input id="agenda" type="text" value="{{$agenda->agenda}}" placeholder="add agenda item" class="form-control" name="agenda" required autofocus>
                                                    
                                                    </div>
                                                </div>
                                                <input class="form-control" type="hidden" name="meeting_id" value="{{$meeting->id}}">
                                                <br>
                                                <input class="form-control" type="hidden" value="{{$agenda->id}}" name="agendaid">

                                                <button type="submit" style="margin-top:-5%" class="col-md-2 btn btn-info btn-lg">Edit</button>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteSlide{!! $agenda->id !!}" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Delete this agenda?</h4>
                                        </div>
                                        <div class="modal-body">
                                            are you sure you want to delete this agenda item?
                                            <hr />
                                            <div class="comment-body">

                                                <div class="mail-contnet">
                                                    <span class="mail-desc"> {{$agenda->agenda}}</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <span class="pull-left">

                                                <form method="post" action="/agenda_delete">
                                                    {{ csrf_field() }}
                                                    <input class="form-control" type="hidden" name="agendaid" hidden="hidden" value="{{$agenda->id}}">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-info">Ok</button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="white-box">
                no agenda could found!
            </div>

            @endif
        </div>

    </div>

</div>
@endif
</div>
@endsection