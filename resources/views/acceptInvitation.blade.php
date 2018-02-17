@extends('layouts.app') @section('content')
<div class="container-fluid">
       
    <div class="row" style="margin-top:2%">

                <div class="col-md-8 col-md-offset-2">

                <form method="POST" action="/accepted">
                {{ csrf_field() }}
                <input type="text" name="invitingId" hidden="hidden" value="{{$invitingId}}">
                <input type="text" name="meeting_id" hidden="hidden" value="{{$meeting_id}}">
                <button type="submit" id="button" class="btn btn-info btn-lg">Accept Invitation</button>
            </form>

            </div>
    </div>
</div>
@endsection

