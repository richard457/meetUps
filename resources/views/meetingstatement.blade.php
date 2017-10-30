@extends('layouts.app') @section('content')
<div class="container" style="padding:1em;">
    <div class="row">



        <div class="col-md-12" style="min-width:750px;" @if(sizeof($meetingstatement)>0)>

            <div class="panel panel-primary">
                <div class="panel-heading">Meeting </div>

                <div class="panel-body">
                    @foreach($meetingstatement as $meet)
                    <li style="padding:1em;display:block;background:#fff;margin-bottom:10px;">
                        <span id="meetting"> {{$meet->title}} </span>

                        <div>
                            <div class="panel-footer">
                                Starting date: {{$meet->date}}
                            </div>
                            <hr />
                            <div class="panel panel-default" @if(sizeof($meetingAgender)>0)>
                                <div class="panel-heading">Agenda</div>

                                <div class="panel-body">

                                    @foreach($meetingAgender as $agenda)
                                    <div class="panel panel panel-info">
                                        <div class="panel-heading"> {{$agenda->title}} </div>
                                        <div class="panel-body">
                                            {{$agenda->contents}}

                                            <hr />
                                         <a href="/agendComment/{{$agenda->id}}/{{$invitingId}}/{{$agenda->title}}" class="pull-right">See comments</a>
                                    </div>
                                    @endforeach

                                </div>
                            </div @endif>
                        </div>
                    </li>
                    @endforeach
                </div>
            </div>

        </div @endif>
    </div>
</div>

<div>
</div>
@endsection

