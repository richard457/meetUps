@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard > Members</h4>
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
                    <div class="panel-heading">Register new Member</div>
                    <div class="panel-body">

                        <form method="post" action="members">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <label for="fullname" class="col-md-4 control-label">Full name</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text" placeholder="full name of members" class="form-control" name="fullname" value="{{ old('fullname') }}"
                                        required autofocus> @if ($errors->has('fullname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="email address" class="form-control" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" placeholder="phone number" class="form-control" name="phone" value="{{ old('phone') }}" required> @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" placeholder="address eg(kgt 20,kigali rwanda)" class="form-control" name="address" value="{{ old('address') }}"
                                        required> @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id">
                            <br />
                            <div class="col-md-6">
                                <br />
                                <center>
                                    <button type="submit" class="btn btn-info btn-lg">Save</button>
                                </center>
                            </div>
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
        @if(sizeof($members) >0)
        <div class="panel">
            <div class="sk-chat-widgets">
                <div class="panel panel-default">
                    <div class="panel-heading">MEMBERS LISTING</div>
                    <div class="panel-body">
                        @foreach($members as $members)

                        <ul class="chatonline">
                            <li>
                                <div class="call-chat">
                                    <button data-toggle="modal" data-target="#editSlide{!! $members->id !!}" class="btn btn-success btn-circle btn-lg" type="button">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button data-toggle="modal" data-target="#deleteSlide{!! $members->id !!}" class="btn btn-danger btn-circle btn-lg" type="button">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('images/user.png') }}" alt="user-img" class="img-circle">
                                    <span>{{$members->fullname}}
                                        <small class="text-success"> {{$members->email}} > {{$members->phone}} > {{$members->address}}</small>
                                    </span>
                                </a>
                            </li>

                        </ul>

                        <div class="modal fade" id="editSlide{!! $members->id !!}" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                            

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Edit member</h4>
                                    </div>
                                    <form method="post" action="editmembers">
                                                {{ csrf_field() }}
                                    <div class="modal-body">
                                     
                                      <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                                    <label for="fullname" class="col-md-4 control-label">Full name</label>

                                                    <div class="col-md-6">
                                                        <input id="fullname" type="text" value="{{$members->fullname}}" placeholder="full name of members" class="form-control" name="fullname" value="{{ old('fullname') }}"
                                                            required autofocus> 
                                                            @if ($errors->has('fullname'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('fullname') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                      </div>
<br />
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email" class="col-md-4 control-label">Email</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" value="{{$members->email}}" placeholder="email address" class="form-control" name="email" value="{{ old('email') }}" required> 
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

      <br />                                         <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                    <label for="phone" class="col-md-4 control-label">Phone</label>

                                                    <div class="col-md-6">
                                                        <input id="phone" type="text" placeholder="phone number" value="{{$members->phone}}" class="form-control" name="phone" value="{{ old('phone') }}" required> 
                                                        @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                    <label for="address" class="col-md-4 control-label">Address</label>

                                                    <div class="col-md-6">
                                                        <input id="address" type="text" value="{{$members->address}}" placeholder="address eg(kgt 20,kigali rwanda)" class="form-control" name="address" value="{{ old('address') }}"
                                                            required> 
                                                            @if ($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="form-group">
                                              <input type="hidden" name="memberid" value="{{ $members->id }}">
                                                        <button type="submit" class="btn btn-info btn-lg">Edit</button>
                                                </div>
                                                    
                                              
                                           
                                    </div>
                                    
                                    </form>
                                   
                                </div>
                               
                            </div>
                        </div>


                        <!-- delete members -->
                        <div class="modal fade" id="deleteSlide{!! $members->id !!}" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Delete this member?</h4>
                                    </div>
                                    <div class="modal-body">
                                        are you sure you want to delete this member?
                                        <hr />
                                        <div class="comment-body">

                                            <div class="mail-contnet">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('images/user.png') }}" alt="user-img" style="width:30%;margin-left:34%" class="img-circle">
                                                    <hr />
                                                    <span style="margin-left:34%">{{$members->fullname}} > {{$members->phone}}
                                                        <small class="text-success">{{$members->address}}</small>
                                                    </span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="pull-left">

                                            <form method="post" action="member_delete">
                                                {{ csrf_field() }}
                                                <input class="form-control" type="hidden" name="memberid" hidden="hidden" value="{{$members->id}}">
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
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">MEMBERS LISTING</div>
                        <div class="panel-body">
                            <div class="white-box">
                                no members could found!
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>

    </div>

    @endsection