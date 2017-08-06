@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8" style="margin-left:-185px;">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form method="post" action="meeting">
                        {{ csrf_field() }}
                        <input class="form-control" placeholder="title of the meeting"><br>
                        <input class="form-control" placeholder="Issue"><br>
                        <button typpe="submit" class="btn btn-info btn-lg">Save meeting</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
