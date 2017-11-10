@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard > Meeting > ISSUES</h4>
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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Issues happened in Meeting</div>
               
                <div class="panel-body">
                    <form method="post" action="/issues">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('person_in_charge_name') ? ' has-error' : '' }}">
                            <label for="person_in_charge_name" class="col-md-4 control-label">Person Responsible</label>

                            <div class="col-md-6">
                                <input id="person_in_charge_name" type="text" placeholder="Person Responsible" class="form-control" name="person_in_charge_name"
                                    value="{{ old('person_in_charge_name') }}" required autofocus> @if ($errors->has('person_in_charge_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('person_in_charge_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                            <label for="contents" class="col-md-4 control-label">Issue in details</label>

                            <div class="col-md-6">
                                <textarea id="issueInDetails" type="text" placeholder="Issue in details" class="form-control" name="issueInDetails" value="{{ old('issueInDetails') }}"
                                    required>

                                </textarea>


                                @if ($errors->has('issueInDetails'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('issueInDetails') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="meeting_id" value="{{$meeting_id}}">
                        <br>
                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id">
                        <br>
                        <button type="submit" class="btn btn-info btn-lg">Save</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-12" @if(sizeof($issues)>0)> @foreach($issues as $issues)
            <div class="col-md-6" style="max-height:40%;height:260px;">
                <div class="panel panel-info">
                    <div class="panel-heading" style="background:{{$issues->backgrandcolor}}">
                        <h5 style="color:#fff;">Person in charge: {{$issues->person_in_charge_name}}</h5>
                    </div>
                    <div class="panel-body">
                        {{$issues->issueInDetails}}
                    </div>
                    <div class="panel-footer">
                        <span class="time">Created at: {{ date('F d, Y', strtotime($issues->created_at)) }}</span>
                        <span class="pull-right">
                            <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $issues->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                <i class="ti-close text-danger m-r-5"></i>Delete
                            </a>
                        </span>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteSlide{!! $issues->id !!}" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Delete this issue?</h4>
                                </div>
                                <div class="modal-body">
                                    are you sure you want to delete this issue?
                                    <hr />
                                    <div class="comment-body">

                                        <div class="mail-contnet">
                                            <span class="mail-desc"> {{$issues->issueInDetails}}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="pull-left">

                                        <form method="post" action="/issue_delete">
                                            {{ csrf_field() }}
                                            <input class="form-control" type="hidden" name="issueid" hidden="hidden" value="{{$issues->id}}">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-info">Ok</button>
                                        </form>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <div class="clearfix"> </div>
        </div @endif>
    </div>
</div>
@endsection
