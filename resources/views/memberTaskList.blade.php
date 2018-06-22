<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Meet up with your freind bu using MeetingAPP">
    <meta name="author" content="Ganza respice">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/admin-logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="" />
    <title>MeetingApp</title>

    <link href="{{ asset('/styles/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/styles/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/styles/css/font-awesome.min.css') }}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="styles/css/date.css" />


</head>
<input type="hidden" id="_token" value="{{ csrf_token() }}">
<body class="fix-header">

    <div id="wrapper">
        <div class="row" style="margin-right:48px;">
            <!-- .col -->
            <div class="col-md-12 col-lg-12 col-sm-12" style="margin:40px; height:100vh">
                @if(sizeof($taskList) >0)
                <br />

                <div class="white-box">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <div>Task Assigned

                            </div>
                            <div class="panel-body">
                                <table class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Agenda item</th>
                                            <th>Matters arising during the Meeting</th>
                                            <th>Action to be taken</th>
                                            <th>Responsible Person</th>
                                            <th>Deadline</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($taskList as $task)
                                        <tr>
                                            <td>{{$task->agenda}} </td>
                                            <td>{{$task->matters}}</td>
                                            <td>{{$task->action}}</td>
                                            <td>{{$task->responsible}}</td>
                                            <td>{{ date('F d, Y h:i:sa', strtotime($task->deadline)) }}</td>
                                            <td>
                                                <a href="#" data-toggle="modal" onclick="loadTaskCommets({{$task->agd_id}})" data-target="#comments{!! $task->agd_id !!}" class="btn-rounded btn btn-primary btn-outline">
                                                    <i class="ti-close text-primary m-r-5"></i>Add Comments</a>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="comments{!! $task->agd_id !!}" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                        <h4 class="modal-title" id="myModalLabel">Comments </h4>
                                                    </div>
                                                      <div class="modal-body">
                                                       
                                                            <input type="text"id="commenter" name="commenter" hidden="hidden" value="{{$memberid}}">

                                                            <input type="text" id="task_id" name="task_id" hidden="hidden" value="{{$task->agd_id}}">

                                                            <textarea type="text" id="comment" style="overflow-y:hidden;" placeholder="Type your comments ...." rows="4"
                                                                class="form-control col-sm-12 col-md-8 col-lg-8" name="comment" required></textarea>
                                                           
                                                                <button type="submit" id="button" onclick="postTaskComment()" class="col-sm-12 col-md-12 col-lg-12 btn btn-info btn-lg">Post</button>

                                                                <hr />
                                                    <div class="modal-footer">

                                                     <div id="taskComments{{$task->agd_id}}" class="pt-3"></div>

                                                </div>
                                                           
                                                    </div>
                                                  
                                            </div>
                                        </div>
                            


                            @endforeach
                            </tbody>
                            </table>
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

    <script src="{{ asset('styles/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/styles/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/styles/js/dashboard1.js') }}"></script>
    <script src="{{asset('styles/js/pdf.js')}}"></script>
    <script src="{{asset('styles/js/data.js')}}"></script>

</body>

</html>