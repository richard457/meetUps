@extends('layouts.app') @section('content')

<div class="container" style="padding:1em;margin-top:0%">

    <div class="row bg-title" style="margin-top:0%">
        <div class="col-lg-1 col-sm-12 col-md-1 col-xs-12">
            <div class="user-img">
                <img src="{{ asset('images/agenda.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
            </div>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12" style="margin-top:1.4%">

            {{$agendatitle}}
        </div>
        <div class="col-lg-2 col-sm-2 col-md-8 col-xs-12">
            <a href="/meeting/agenda/{{$invitingId}}/{{$meetingid}}" class="btn-rounded btn btn-primary btn-outline">
                <i class="ti-close text-primary m-r-5"></i>Back to agenda</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:125px">
            <div class="panel panel-default">
                <div class="panel-heading">Add comments</div>

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
                        <input type="text" name="agenda" hidden="hidden" value="{{$agendaid}}">
                        <input type="text" name="commenter" hidden="hidden" value="{{$invitingId}}">

                        <textarea type="text" placeholder="Type you comments ...." rows="4" class="form-control col-sm-12 col-md-8 col-lg-8" name="comment"
                            required>Type you comments ....</textarea>
                        <p>

                            <button type="submit" id="button" class="col-sm-12 col-md-12 col-lg-12 btn btn-info btn-lg">Post</button>
                        </p>
                    </form>

                </div>
            </div>
        </div>




        <div class="row">
            <!-- .col -->
            <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                @if(sizeof($agendaComment)>0)
                <div class="white-box">
                    <div class="panel panel-default">
                        <div class="panel-heading">View agenda Comments</div>
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
@endsection