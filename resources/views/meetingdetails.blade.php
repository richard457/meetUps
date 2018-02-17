@extends('layouts.app') @section('content')

<div class="container-fluid">
@if(sizeof($meeting) >0)
  <div class="row bg-title">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        <div class="user-img">
                <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
            </div>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-5"  style="margin-top:1.5%">
            <span>{{$meeting->title}}</span>
            <br /> <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F d, Y h:i:sa', strtotime($meeting->date)) }}</span>, at <i class="fa fa-map-marker" aria-hidden="true"></i> <span class="text-success">{{ $meeting->venue }}</span>
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


        <div class="row">
        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Accepted invitation</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-success"></i>
                        <span class="counter text-success">
                            
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Appending invitation</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-purple"></i>
                        <span class="counter text-purple">
                          
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Meeting attended</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash4"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-danger"></i>
                        <span class="counter text-danger">
                            
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Meeting absent</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash3"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-info"></i>
                        <span class="counter text-info">
                            
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>


        <div class="col-md-12">

        @if(sizeof($comments)>0)
      
                                
                                <div class="white-box">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">View Agenda Comments</div>
                                        <div class="panel-body">
                                            @foreach($comments as $comment)
                                            <div class="comment-center p-t-10">
                                                <div class="comment-body">
                                                    <div class="user-img">
                                                        <img src="{{ asset('images/user.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                                                    </div>
                                                    <div class="mail-contnet">
                                                        <h5>{{$comment->fullname}}
                                                        </h5>
                                                        <span class="time">commented {{ date('F d, Y', strtotime($comment->created_at)) }}</span>
                                                        <br/>
                                                        <span class="mail-desc"> {{$comment->comments}} </span>
                                                       
                                                        <span class="pull-right">
                                                            <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $comment->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                                                <i class="ti-close text-danger m-r-5"></i>Delete</a>
                                                        </span>
                                                       
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="modal fade" id="deleteSlide{!! $comment->id !!}" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">Delete this meeting?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            are you sure you want to delete this comment?
                                                            <hr />
                                                            <div class="comment-body">

                                                                <div class="mail-contnet">
                                                                    <span class="mail-desc"> {{$comment->comments}}</span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span class="pull-left">

                                                                <form method="post" action="/_comment_delete">
                                                                    {{ csrf_field() }}
                                                                    <input class="form-control" type="hidden" name="commentid" hidden="hidden" value="{{$comment->id}}">
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
                            
                            @else
                            <div class="white-box">
                                no comments could found!
                            </div>
               </div>
                            @endif
    </div>
    @endif
</div>

    
@endsection