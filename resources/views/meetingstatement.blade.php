@extends('layouts.app') @section('content')
<div class="container" style="padding:1em;margin-top:0%">
    <div class="row">



        <div class="col-md-12" style="min-width:750px;" @if(sizeof($meetingstatement)>0)>

            <div class="panel panel-primary">
                <div class="panel-heading">Meeting </div>

                <div class="panel-body">
                    @foreach($meetingstatement as $meet)

                    <li style="padding:1em;display:block;background:#fff;margin-bottom:10px;">
                         <div class="user-img col-md-1"> 
             <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
              </div>
              <span id="meetting" style="margin-top:1.4%" class="col-md-8"> {{$meet->title}} </span>

                        <div>
                            <div class="pull-right col-md-3 btn btn btn-rounded btn-default btn-outline m-r-5" style="margin-top:-5%">
                                 <span class="time"> Starting date: {{ date('F d, Y', strtotime($meet->date)) }}</span>
                            </div>
                           


                           

        <div class="row">
                    <!-- .col -->
                        <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                        @if(sizeof($meetingAgender)>0)
                                <div class="white-box">
                                        <div class="panel panel-default">
                                        <div class="panel-heading">View All Agenda</div>
                                            <div class="panel-body">
                                            @foreach($meetingAgender as $agenda)
                                                    <div class="comment-center p-t-10">
                                                            <div class="comment-body">
                                                                    <div class="user-img"> 
                                                                        <img src="{{ asset('images/agenda.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                                                                    </div>
                                                                    <div class="mail-contnet">
                                                                        <h5>{{$agenda->title}}</h5><span class="time">{{ date('F d, Y', strtotime($agenda->created_at)) }}</span>
                                                                        <br/><span class="mail-desc"> {{$agenda->contents}} </span>
                                                                        <a href="/agendComment/{{$agenda->id}}/{{$invitingId}}/{{$agenda->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-success m-r-5"></i>View commemts related</a>
                                                                       
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
                                          no agenda could found!
                                        </div>

                                @endif
                        </div>
                
                </div>

    </div>



                         
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

