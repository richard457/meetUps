@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard > Meeting > Invited</h4>
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

                                                    <form method="post" action="/invites">
                                                        <button type="submit" class="col-md-12 btn btn-info btn-material-pink btn-raised">Invite
                                                        </button>

                                                        {{ csrf_field() }}
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Invite</th>
                                                                    <th>Email Address</th>
                                                                    <th>Other address</th>
                                                                    <th>Phone number</th>
                                                                    <th colspan="2">Option</th>
                                                                </tr>
                                                                @foreach($invites as $invites)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input type='checkbox' name="check[]" value="{{$invites->id}},{{$invites->email}},{{$meeting_id}}">
                                                                        </td>
                                                                        <td>{{$invites->fullname}} </td>
                                                                        <td>{{$invites->fullname}} </td>
                                                                        <td>{{$invites->email}}
                                                                        </td>
                                                                        <td>{{$invites->phone}} </td>
                                                                        <td>{{$invites->address}} </td>

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
                                                        <input type="hidden" name="meeting_id" value="{{$meeting_id}}">
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
                                                                                <button class="btn btn-success btn-circle btn-lg" type="button">
                                                                                    <i class="fa fa-phone"></i>
                                                                                </button>
                                                                                <button class="btn btn-danger btn-circle btn-lg" type="button">
                                                                                    <i class="fa fa-comments-o"></i>
                                                                                </button>
                                                                            </div>
                                                                            <a href="javascript:void(0)">
                                                                                <img src="{{ asset('images/user.png') }}" alt="user-img"
                                                                                    class="img-circle">
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
                                                                                <button class="btn btn-success btn-circle btn-lg" type="button">
                                                                                    <i class="fa fa-phone"></i>
                                                                                </button>
                                                                                <button class="btn btn-danger btn-circle btn-lg" type="button">
                                                                                    <i class="fa fa-comments-o"></i>
                                                                                </button>
                                                                            </div>
                                                                            <a href="javascript:void(0)">
                                                                                <img src="{{ asset('images/user.png') }}" alt="user-img"
                                                                                    class="img-circle">
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
    </div>
    @endsection
    <script>
        function chooseExecel() {
            var files = document.getElementById('chooseExecel').files[0];
            console.log(files);
        }
    </script>


</div>