@extends('layouts.app') @section('content')

<div class="container-fluid">

    @if(sizeof($meeting) >0)
    <div class="row bg-title">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <div class="user-img">
                <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
            </div>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-5" style="margin-top:1.5%">
            <span>{{$meeting->title}}</span>
            <br />
            <span class="time">
                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F d, Y h:i:sa', strtotime($meeting->date)) }}</span>, at
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span class="text-success">{{ $meeting->venue }}</span>
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
        <div class="col-md-12">
            <div class="panel-body">

                <div class="col-md-12" @if(sizeof($invites)>0)>


                    <div class="panel panel-default">
                        <div class="panel-heading">Meeting Invited </div>
                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#SendInvitation" aria-controls="home" role="tab" data-toggle="tab">Send Invitation</a>
                                </li>
                                <li role="presentation">
                                    <a href="#ViewInvited" aria-controls="profile" role="tab" data-toggle="tab">View Invited</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="SendInvitation">
                                    <div class="panel-body">


                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has('alert-' . $msg))

                                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </p>
                                        @endif @endforeach
                                        <div>

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Select Members</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Import Excel file</a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="home">
                                                    <form class="form-inline" id="testForm" role="form" method="POST" action="{{action('InvitesController@store')}}">
                                                        <button type="submit" class="col-md-12 btn btn-info btn-material-pink btn-raised">Invite
                                                        </button>

                                                        {{ csrf_field() }}
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Invite</th>
                                                                    <th>Name</th>
                                                                    <th>Email Address</th>
                                                                    <th>Other address</th>
                                                                    <th>Phone number</th>
                                                                    <th>Position</th>
                                                                </tr>
                                                                @foreach($invites as $invites)
                                                                <tbody>
                                                               
                                                                    <tr>
                                                                        <td>
                                                                            <input type='checkbox' name="check[]" value="{{$invites->id}},{{$invites->email}},{{$meeting->id}}">
                                                                        </td>
                                                                        <td>{{$invites->fullname}} </td>
                                                                        <td>{{$invites->email}}
                                                                        </td>
                                                                        <td>{{$invites->phone}} </td>
                                                                        <td>{{$invites->address}} </td>

                                                                        <td>{{$invites->position}} </td>

                                                                    </tr>
                                                                </tbody>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </form>

                                                </div>



                                                <div role="tabpanel" class="tab-pane" id="profile">
                                                    <form method="post" action="/upload" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="meeting_id" value="{{$meeting->id}}">
                                                        <input type="file" name="csv" class="col-md-3">
                                                        <button type="submit" class="col-md-3 btn btn-info btn-material-pink btn-raised">Invite
                                                        </button>

                                                    </form>
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="ViewInvited">

                                    <!-- list of members accepted invitation -->

                                    <div>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#acceptedinvitation" aria-controls="home" role="tab" data-toggle="tab">Accepted Invitation</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#appendinginvitaion" aria-controls="profile" role="tab" data-toggle="tab">Appending now..</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="acceptedinvitation">

                                                <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                                                    @if(sizeof($acceptinvitation) >0)
                                                    <div class="panel">
                                                        <div class="sk-chat-widgets">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">ACCEPTED INVTIATION LISTING</div>
                                                                <div class="panel-body">
                                                                    @foreach($acceptinvitation as $members)

                                                                    <ul class="chatonline">
                                                                        <li>
                                                                            <div class="call-chat">
                                                                             
                                                                            </div>
                                                                            <a href="javascript:void(0)">
                                                                                <img src="{{ asset('images/user.png') }}" alt="user-img" class="img-circle">
                                                                                <span>{{$members->fullname}} > {{$members->phone}}
                                                                                    <small class="text-success">{{$members->address}}</small>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                    </ul>


                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="panel">
                                                        <div class="sk-chat-widgets">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">ACCEPTED INVTIATION LISTING</div>
                                                                <div class="panel-body">
                                                                    <div class="white-box">
                                                                        no accepted invitation could found!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    @endif
                                                </div>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="appendinginvitaion">

                                                <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                                                    @if(sizeof($appendinginvitation) >0)
                                                    <div class="panel">
                                                        <div class="sk-chat-widgets">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">APPENDING INVTIATION LISTING</div>
                                                                <div class="panel-body">
                                                                    @foreach($appendinginvitation as $members)

                                                                    <ul class="chatonline">
                                                                        <li>
                                                                            <div class="call-chat">
                                                                             
                                                                            </div>
                                                                            <a href="javascript:void(0)">
                                                                                <img src="{{ asset('images/user.png') }}" alt="user-img" class="img-circle">
                                                                                <span>{{$members->fullname}} > {{$members->phone}}
                                                                                    <small class="text-success">{{$members->address}}</small>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                    </ul>


                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="panel">
                                                        <div class="sk-chat-widgets">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">APPENDING INVTIATION LISTING</div>
                                                                <div class="panel-body">
                                                                    <div class="white-box">
                                                                        no appending invitation could found!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                </form>


            </div @endif>



        </div>
        @endif
    </div>
    @endsection
    <script>
        function chooseExecel() {
            var files = document.getElementById('chooseExecel').files[0];
            console.log(files);
        }
    </script>


</div>