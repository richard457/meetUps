@extends('layouts.app') @section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">

                    <div class="col-md-12" @if(sizeof($invites)>0)>


                            <div class="panel panel-default">
                                <div class="panel-heading"> List of invites </div>

                                <div class="panel-body">

                                    <form method="post" action="/upload" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="meeting_id" value="{{$meeting_id}}">
                                        <input type="file" name="csv">


                                        <input type="submit"/>
                                    </form>

                                    <div class="fileinput btn btn-success btn-material-pink btn-raised"
                                         onclick="document.getElementById('chooseExecel').click()">
                                        <i class="fa fa-upload"></i>
                                        <span> Import Excel </span>
                                        <input type="file" type="hidden" name="type" value="csv" id="chooseExecel"
                                               onChange="chooseExecel()">

                                    </div>
                                    </form>
                                    <form method="post" action="invites">
                                        <button type="submit" class="btn btn-info btn-material-pink btn-raised">Invite
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
                                                    <td><input type='checkbox' name="check[]" value="{{$invites->id}}, {{$invites->email}}"></td>
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