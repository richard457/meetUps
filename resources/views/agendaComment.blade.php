@extends('layouts.app') @section('content')
<div class="container" style="padding:1em;" style="background:#fff">
    <div class="row" style="background:#fff">

        <div class="container" style="background:#fff" @if(sizeof($agendaComment)>0)>

            <div class="row">
                <div class="col-md-12 panel panel-primary">
                    <div class="panel-heading">Agenda :: {{$agendatitle}}</div>

                </div>
                <!-- /col-sm-12 -->
            </div>
            <!-- /row -->
            @foreach($agendaComment as $comment)
            <div class="row">
                <div class="col-sm-1">
                    <div class="thumbnails">
                        <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                    </div>
                    <!-- /thumbnail -->
                </div>
                <!-- /col-sm-1 -->

                <div class="col-sm-8">
                    <div class="panels panel-default">
                        <div class="panel-heading">
                            <strong>myusername</strong>
                            <span class="text-muted">commented 5 days ago</span>
                        </div>
                        <div class="panel-body">
                            {{$comment->comments}}
                        </div>
                        <!-- /panel-body -->
                    </div>
                    <!-- /panel panel-default -->
                </div>
                <!-- /col-sm-5 -->

            </div>
            <!-- /row -->
            @endforeach

        </div>
        <!-- /container -->
    </div @endif>
    <div class="panel-footer" style="height:100px">
        <form method="POST" action="/comments">
            {{ csrf_field() }}
            <input type="text" name="agenda" hidden="hidden" value="{{$comment->id}}">
            <input type="text" name="commenter" hidden="hidden" value="{{$invitingId}}">

            <textarea type="text" placeholder="Type you comments ...." rows="4" class="form-control col-sm-12 col-md-10 col-lg-10" name="comment"
                required> </textarea>
            &nbsp;&nbsp;&nbsp;
            <button type="submit" id="button" class="btn btn-info btn-lg">Post</button>
        </form>

    </div>

    <div>
    </div>
    @endsection