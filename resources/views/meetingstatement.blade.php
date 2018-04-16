<html>

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="" />
    <title>MeetingApp</title>

    <link href="{{ asset('/styles/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{ asset('/styles/css/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{ asset('/styles/css/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ asset('/styles/css/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('/styles/plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/styles/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}"
        rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('/styles/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/styles/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('/styles/css/colors/default.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/styles/css/font-awesome.min.css') }}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="styles/css/date.css" />
</head>

<body>
    <div class="content" style="padding:1em;margin:2%">
        <div class="row">



            <div class="col-md-9" style="min-width:750px;" @if(sizeof($meetingstatement)>0)>

                <div class="panel panel-primary">
                    <div class="panel-heading">Meeting </div>

                    <div class="panel-body">
                        @foreach($meetingstatement as $meet)

                        <li style="padding:1em;display:block;background:#fff;margin-bottom:10px;">
                            <div class="user-img col-md-1">
                                <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                            </div>
                            <span id="meetting" style="margin-top:1.4%" class="col-md-11"> {{$meet->title}}
                                <br />

                                <span class="time">
                                    Starting date:
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F d, Y h:i:sa', strtotime($meet->date)) }}</span>,
                                <span class="text-success">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{$meet->venue}}</span>
                            </span>


                            <div>






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
                                                            <span class="time">commented {{ date('F d, Y', strtotime($comment->created_at))
                                                                }}
                                                            </span>
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
            <div class="col-md-3">
            <div class="modal-content">
            <div class="modal-heading">
                Task Assigned
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
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

    <footer>
        <script src="{{ asset('styles/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('/styles/js/bootstrap.min.js') }}"></script>

        <!-- Menu Plugin JavaScript -->
        <script src="{{ asset('/styles/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
        <!--slimscroll JavaScript -->
        <script src="{{ asset('/styles/js/jquery.slimscroll.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ asset('/styles/js/waves.js') }}"></script>
        <!--Counter js -->
        <script src="{{ asset('/styles/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
        <script src="{{ asset('/styles/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
        <!-- chartist chart -->
        <script src="{{ asset('/styles/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('/styles/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="{{ asset('/styles/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('/styles/js/custom.min.js') }}"></script>
        <script src="{{ asset('/styles/js/dashboard1.js') }}"></script>
        <script src="{{ asset('/styles/js/colResizable.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/styles/js/FileSaver.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/styles/js/jquery.wordexport.js') }}"></script>
        <script src="{{ asset('/styles/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
        <script src="{{asset('/styles/js/moment.js')}}"></script>
        <script src="{{asset('styles/js/pdf.js')}}"></script>
        <script src="{{asset('styles/js/date.js')}}"></script>
    </footer>
</body>

</html>