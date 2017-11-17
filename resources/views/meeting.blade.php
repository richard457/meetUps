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
          
                <div class="panel panel-default">
                    <div class="panel-heading">Add Meeting</div>
                    <div class="panel-body">

                        <form method="post" action="meeting">
                            {{ csrf_field() }}
                            <input class="form-control" placeholder="meeting handle" type="hidden" value="{{Auth::id()}}" name="user_id">
                            <table>

                            <tr>
                            <td class="col-md-2">
                                <label>Meeting </label>
                            </td>
                            <td class="col-md-10">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <textarea class="form-control" onkeydown="autoResize(event)" style="overflow-y:hidden;" name="title" rows='5' placeholder="meeting handle" required autofocus>{{ old('title') }}</textarea>
                                
                                                  @if ($errors->has('title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                    @endif
                            </div>

                            </td>    
                               
                            </tr>
                            <tr><td>&nbsp;</td> <td>&nbsp;</td> </tr>
                            <tr>
                            <td class="col-md-2">
                                  <label class="col-md-2">Date </label>
                            </td>
                                <td class="col-md-10">
                               
                                         <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                                <div class='input-group date' id='datepicker'>
                                                    <input type='text' name="date" class="form-control" value="{{ old('date') }}" required>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                                @if ($errors->has('date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('date') }}</strong>
                                                    </span>
                                                    @endif
                                        </div>
                                    </div>
                                  
                               
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td> <td>&nbsp;</td> </tr>
                            <tr>
                            <td class="col-md-2">
                                <label class="col-md-2">Venue </label>
                            </td>
                            <td class="col-md-10">
                            <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
                                <input type='text' name="venue" placeholder="venue ..." value="{{ old('venue') }}" class="col-md-10 form-control" required>
                                                 @if ($errors->has('venue'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('venue') }}</strong>
                                                    </span>
                                                    @endif
                            </div>
                            </td>  
                            </tr> 
                            <tr><td>&nbsp;</td> <td>&nbsp;</td> </tr>
                            <tr>
                            <td colspan="3">      
                            <button type="submit" class="col-md-12 btn btn-info btn-lg">Schedule Meeting</button>
                            </td>
                            </tr>
                            </table>
                        </form>
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
                            <a href="/_meeting/{{$meet->id}}">
                                <div class="mail-contnet">
                                    <h5>{{$meet->name}}</h5>
                                    <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F d, Y h:i:sa', strtotime($meet->date)) }}</span>, at <i class="fa fa-map-marker" aria-hidden="true"></i> <span class="text-success">{{ $meet->venue }}</span>
                                    <br/>
                                    <span class="mail-desc"> {{$meet->title}}</span>
                                    
                                    <span class="pull-right">
                                        <a href="#" data-toggle="modal" data-target="#deleteSlide{!! $meet->id !!}" class="btn-rounded btn btn-danger btn-outline">
                                            <i class="ti-close text-danger m-r-5"></i>Delete</a>
                                        <a href="#" data-toggle="modal" data-target="#editSlide{!! $meet->id !!}" class="btn-rounded btn btn-primary btn-outline">
                                            <i class="ti-close text-primary m-r-5"></i>Edit</a>
                                    </span>
                                </div>
                            </a>
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
                                        
                                        <input class="form-control"  type="hidden" value="{{$meet->id}}" name="meetingid">
                                        <input class="form-control"  type="hidden" value="{{Auth::id()}}" name="user_id">
                                        <table>

                                        <tr>
                                        <td class="col-md-2">
                                            <label>Meeting </label>
                                        </td>
                                        <td class="col-md-10">
                                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <textarea class="form-control" onkeydown="autoResize(event)" style="overflow-y:hidden;" name="title" rows='5' placeholder="meeting handle" required autofocus>{{ $meet->title}}</textarea>
                                            
                                                            @if ($errors->has('title'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('title') }}</strong>
                                                                </span>
                                                                @endif
                                        </div>

                                        </td>    
                                        
                                        </tr>
                                        <tr><td>&nbsp;</td> <td>&nbsp;</td> </tr>
                                        <tr>
                                        <td class="col-md-2">
                                            <label class="col-md-2">Date </label>
                                        </td>
                                            <td class="col-md-10">
                                        
                                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                                            <div class='input-group date' id='datepicker'>
                                                                <input type='text' value="{{ $meet->date}}" name="date" class="form-control" value="{{ old('date') }}" required>
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                            @if ($errors->has('date'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('date') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                </div>
                                            
                                        
                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td> <td>&nbsp;</td> </tr>
                                        <tr>
                                        <td class="col-md-2">
                                            <label class="col-md-2">Venue </label>
                                        </td>
                                        <td class="col-md-10">
                                        <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
                                            <input type='text' name="venue" value="{{ $meet->venue}}" placeholder="venue ..." value="{{ old('venue') }}" class="col-md-10 form-control" required>
                                                            @if ($errors->has('venue'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('venue') }}</strong>
                                                                </span>
                                                                @endif
                                        </div>
                                        </td>  
                                        </tr> 
                                        <tr><td>&nbsp;</td> <td>&nbsp;</td> </tr>
                                        <tr>
                                        <td colspan="3">      
                                        <button type="submit" class="col-md-12 btn btn-info btn-lg">Edit Meeting</button>
                                        </td>
                                        </tr>
                                        </table>
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
