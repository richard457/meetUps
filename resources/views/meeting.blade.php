 @extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard > Meeting</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- DISPLAY MEETING -->
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </p>
        @endif @endforeach
    </div>


    <div class="row">
        <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:114px">
            <div class="white-box">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Meeting</div>
                    <div class="panel-body">

                        <form method="post" action="meeting">
                            {{ csrf_field() }}
                            <input class="form-control" name="title" placeholder="meeting handle">
                            <br>
                            <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id">
                            <br>
                            <input class="form-control" name="date" type="date">
                            <br>
                            <button type="submit" class="btn btn-info btn-lg">Schedule Meeting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DISPLAY MEETING -->

<div class="row">
    <!-- .col -->
    <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
        @if(sizeof($meetings) >0)
        <div class="white-box">
            <div class="panel panel-default">
                <div class="panel-heading">View All Meetings</div>
                <div class="panel-body">
                    @foreach($meetings as $meet)
                    <div class="comment-center p-t-10">
                        <div class="comment-body">
                            <div class="user-img">
                                <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                            </div>
                            <div class="mail-contnet">
                                <h5>{{$meet->name}}</h5>
                                <span class="time">{{ date('F d, Y', strtotime($meet->date)) }}</span>
                                <br/>
                                <span class="mail-desc"> {{$meet->title}}</span>
                                <a href="/agenda/{{$meet->id}}/{{$meet->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                    <i class="ti-check text-success m-r-5"></i>Agenda</a>
                                <a href="/invites/{{$meet->id}}/{{$meet->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                    <i class="ti-check text-primary m-r-5"></i>Invite</a>
                                <a href="/issues/{{$meet->id}}/{{$meet->title}}" class="btn-rounded btn btn-default btn-outline">
                                    <i class="ti-close text-danger m-r-5"></i> Issues</a>
                                <span class="pull-right">
                                    <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $meet->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                        <i class="ti-close text-danger m-r-5"></i>Delete</a>
                                    <a href="#" data-toggle="modal" data-target="#editSlide{!! $meet->id !!}" class="btn-rounded btn btn-primary btn-outline">
                                        <i class="ti-close text-primary m-r-5"></i>Edit</a>
                                </span>
                            </div>
                        </div>


                    </div>

                    <div class="modal fade" id="editSlide{!! $meet->id !!}" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">


                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Edit meeting</h4>
                                </div>

                                <div class="panel-body">

                                    <form method="post" action="editmeeting">
                                        {{ csrf_field() }}
                                        <label>Title</label>
                                        <input class="form-control" name="title" value="{{$meet->title}}" placeholder="meeting handle">
                                        <br>
                                        <input class="form-control" type="hidden" value="{{$meet->id}}" name="meetingid">
                                        <br>
                                        <label>Date</label>
                                        <input class="form-control" name="date" value="{{$meet->date}}" type="date">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-lg">Edit</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteSlide{!! $meet->id !!}" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Delete this meeting?</h4>
                                </div>
                                <div class="modal-body">
                                    are you sure you want to delete this meeting?
                                    <hr />
                                    <div class="comment-body">

                                        <div class="mail-contnet">
                                            <span class="mail-desc"> {{$meet->title}}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="pull-left">

                                        <form method="post" action="meeting_delete">
                                            {{ csrf_field() }}
                                            <input class="form-control" type="hidden" name="meetingid" hidden="hidden" value="{{$meet->id}}">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-info">Ok</button>
                                        </form>
                                    </span>
                                    <span class="time">{{$meet->name}}, {{ date('F d, Y', strtotime($meet->date)) }}</span>
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
        no meeting could found!
    </div>

    @endif
</div>

</div>

</div>

@endsection

<script>
    function printMetting() {
        var print = document.getElementById('meetting').innerHTML;
        var currentFile = document.body.innerHTML;
        document.body.innerHTML = print;
        window.print();
        document.body.innerHTML = currentFile;
    }
</script>