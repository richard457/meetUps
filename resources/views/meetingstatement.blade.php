@extends('layouts.app') @section('content')
<div class="container" style="padding:1em;margin-top:0%">
    <div class="row">



        <div class="col-md-12" style="min-width:750px;" @if(sizeof($meetingstatement)>0)>

            <div class="panel panel-primary">
                <div class="panel-heading">Meeting </div>

                <div class="panel-body">
                    @foreach($meetingstatement as $meet)

                    <li style="padding:1em;display:block;background:#fff;margin-bottom:10px;">
                        <div class="user-img col-md-1">
                            <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                        </div>
                        <span id="meetting" style="margin-top:1.4%" class="col-md-8"> {{$meet->title}}
                            <br />
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span class="text-success">{{$meet->venue}}</span>
                        </span>


                        <div>
                            <div class="pull-right col-md-3 btn btn btn-rounded btn-default btn-outline m-r-5" style="margin-top:-5%">
                                <span class="time"> Starting date: {{ date('F d, Y', strtotime($meet->date)) }}</span>

                            </div>





                            <div class="row">
                                <!-- .col -->
                                <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                                    @if(sizeof($meetingAgender)>0)
                                    <div class="white-box">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">View All Agenda item</div>
                                            <div class="panel-body">
                                                @foreach($meetingAgender as $agenda)
                                                <div class="comment-center p-t-10">
                                                    <div class="comment-body">
                                                        <div class="user-img">
                                                            <img src="{{ asset('images/agenda.png') }}" style="margin-left:10%;width:40px" alt="user" class="img-circle">
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <h5>{{$agenda->agenda}}</h5>
                                                            <span class="time">{{ date('F d, Y', strtotime($agenda->created_at)) }}</span>


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

                            <div class="col-md-12" style="min-width:750px;">

                                <div class="panel panel-primary">
                                    <div class="panel-heading">Meeting Comments </div>
                                </div>
                                <div class="panel-body">
                                    <div class="flash-message">
                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has('alert-' . $msg))

                                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </p>
                                        @endif @endforeach
                                    </div>

                                    <form method="POST" action="/comments">
                                        {{ csrf_field() }}

                                        <input type="text" name="commenter" hidden="hidden" value="{{$invitingId}}">

                                        <input type="text" name="meetingid" hidden="hidden" value="{{$meeting_id}}">

                                        <textarea type="text" onkeydown="autoResize(event)" style="overflow-y:hidden;" placeholder="Type you comments ...." rows="4"
                                            class="form-control col-sm-12 col-md-8 col-lg-8" name="comment" required></textarea>
                                        <p>

                                            <button type="submit" id="button" class="col-sm-12 col-md-12 col-lg-12 btn btn-info btn-lg">Post</button>
                                        </p>
                                    </form>

                                </div>


                            </div>
                            <div class="panel-body">
                                @if(sizeof($agendaComment)>0)
                                <div class="white-box">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">View Agenda Comments</div>
                                        <div class="panel-body">
                                            @foreach($agendaComment as $comment)
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
                                                        @if($invitingId ==$comment->commenter)
                                                        <span class="pull-right">
                                                            <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $comment->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                                                <i class="ti-close text-danger m-r-5"></i>Delete</a>
                                                        </span>
                                                        @endif
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

                                                                <form method="post" action="/comment_delete">
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
                            </div>
                            @else
                            <div class="white-box">
                                no comments could found!
                            </div>

                            @endif
                        </div>
                </div>


            </div>

        </div>




    </div>
    </li>
    @endforeach
</div>
</div>

</div @endif>
</div>
</div>

<div>
</div>
@endsection