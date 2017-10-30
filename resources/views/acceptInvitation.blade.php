@extends('layouts.app') @section('content')
<div class="container" style="padding:1em;">
    <div class="row">

    <div class="col-md-6 col-md-offset-3">

    <form method="POST" action="/accepted">
    {{ csrf_field() }}
    <input type="text" name="invitingId" hidden="hidden" value="{{$invitingId}}">
    <input type="text" name="meeting_id" hidden="hidden" value="{{$meeting_id}}">
    <button type="submit" id="button" class="btn btn-info btn-lg">Accept Invitation</button>
</form>

</div>
</div>
@endsection

