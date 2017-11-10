@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard > Setting</h4>
        </div>

    </div>
    <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                    @endif @endforeach
                </div>
    <div class="col-lg-10 col-md-10 col-md-offset-1 col-xs-12" style="background:#fff">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#settinginfo" aria-controls="home" role="tab" data-toggle="tab">User setting</a>
                                            </li>
                                           
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="settinginfo">
                                            <div class="white-box">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">Change password</div>
                                                        <div class="panel-body">

                                                            <form method="post" action="changesetting">
                                                                {{ csrf_field() }}
                                                                <input class="form-control" name="email" value="{{Auth::user ()->email}}" placeholder="email" require>
                                                                <br>
                                                                <input class="form-control" name="name" value="{{Auth::user ()->name}}" placeholder="name" require>
                                                                <br>
                                                                <input class="form-control" type="password" name="password" placeholder="Enter new password" require>
                                                                
                                                                <br>
                                                                <button type="submit" class="btn btn-info btn-lg">Change</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>

    </div>
    @endsection