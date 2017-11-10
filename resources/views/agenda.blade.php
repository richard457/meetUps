@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard > Meeting > AGENDA</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row bg-title" style="margin-top:-1.7%">
        <div class="col-lg-1 col-sm-12 col-md-1 col-xs-12">
            <div class="user-img">
                <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
            </div>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            {{$meetingtitle}}
        </div>
        <!-- /.col-lg-12 -->
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

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" placeholder="title of agenda" class="form-control" name="title" value="{{ old('title') }}"
                                    required autofocus> @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                            <label for="contents" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="contents" type="text" placeholder="contents of agenda" class="form-control" name="contents" value="{{ old('contents') }}"
                                    required> @if ($errors->has('contents'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contents') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="meeting_id" value="{{$meeting_id}}">
                        <br>
                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id">
                        <br>
                        <button type="submit" class="btn btn-info btn-lg">Save Agenda</button>
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
                                        <h5>{{$agenda->title}}</h5>
                                        <span class="time">{{ date('F d, Y', strtotime($agenda->created_at)) }}</span>
                                        <br/>
                                        <span class="mail-desc"> {{$agenda->contents}} </span>
                                        <a href="/agendComment/{{$agenda->id}}/{{Auth::id()}}/{{$agenda->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="ti-check text-success m-r-5"></i>View commemts related</a>
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
                                    <h4 class="modal-title" id="myModalLabel">Edit agenda</h4>
                                </div>

                                <div class="panel-body">

                                          <form method="post" action="/editagenda">
                                                {{ csrf_field() }}

                                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                                    <label for="title" class="col-md-3 control-label">Title</label>

                                                    <div class="col-md-9">
                                                        <input id="title" type="text" placeholder="title of agenda" value="{{$agenda->title}}" class="form-control" name="title" value="{{ old('title') }}"
                                                            required autofocus> @if ($errors->has('title'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                                                    <label for="contents" class="col-md-12 control-label">Description</label>

                                                    <div class="col-md-12">
                                                        <textarea id="contents" rows="10" type="text"  placeholder="contents of agenda" class="form-control" name="contents" value="{{ old('contents') }}"
                                                            required>{{$agenda->contents}}</textarea> 
                                                            @if ($errors->has('contents'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('contents') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br />
                                                <input class="form-control" type="hidden" name="meeting_id" value="{{$meeting_id}}">
                                                <br>
                                                <input class="form-control" type="hidden" value="{{$agenda->id}}" name="agendaid">
                                                <br /><br />
                                                <button style="margin-top:2%" type="submit" class="btn btn-info btn-lg">Edit</button>
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
                                    are you sure you want to delete this agenda?
                                    <hr />
                                    <div class="comment-body">

                                        <div class="mail-contnet">
                                            <span class="mail-desc"> {{$agenda->title}}</span>

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
</div>
@endsection
