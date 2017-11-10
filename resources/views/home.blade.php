@extends('layouts.app') @section('content')


<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- ============================================================== -->
    <!-- Different data widgets -->
    <!-- ============================================================== -->
    <!-- .row -->
    <div class="row">
        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Members</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-success"></i>
                        <span class="counter text-success">
                            {{$tmembers}}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Daily Meetings</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-purple"></i>
                        <span class="counter text-purple">
                            {{$dmeeting}}
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Upcoming Meetings</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash4"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-danger"></i>
                        <span class="counter text-danger">
                            {{$upmeeting}}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Invites</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash3"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-info"></i>
                        <span class="counter text-info">
                            {{$tinvites}}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.row -->

    <!-- ============================================================== -->
    <!-- chat-listing & recent comments -->
    <!-- ============================================================== -->
    @if(sizeof($getDailyMeeting) >0)
   <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
        <div class="row">
            <div class='col-md-offset-2 col-md-8 text-center'>
            <h2>Today ,{{ date('F d, Y', strtotime($today)) }}, #Meeting</h2>
            </div>
        </div>

        <div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#quote-carousel" data-slide-to="1"></li>
          <li data-target="#quote-carousel" data-slide-to="2"></li>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        
          <!-- Quote 1 -->
          <div class="item active">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                <img class="img-circle" src="{{ asset('images/meeting_gif.gif') }}" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>Hi there! this is daily meeting</p>
                  <small>Please take care of it!</small>
                </div>
              </div>
            </blockquote>
          </div>
     
          <!-- Quote 3 -->

          @foreach($getDailyMeeting as $meet)

          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                <img class="img-circle" src="{{ asset('images/meeting.png') }}" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p class="itemlist">{{$meet->title}}</p>
                  <small>{{$meet->name}}, <span class="time">{{ date('F d, Y', strtotime($meet->date)) }}</span></small>
                  <span class="pull-right">

                  <a href="/agenda/{{$meet->id}}/{{$meet->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-success m-r-5"></i>Agenda</a>
                   <a href="/invites/{{$meet->id}}/{{$meet->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-primary m-r-5"></i>Invite</a>
                    <a href="/issues/{{$meet->id}}/{{$meet->title}}" class="btn-rounded btn btn-default btn-outline"><i class="ti-close text-danger m-r-5"></i> Issues</a>
                                                                  
                  </span>
                </div>
              </div>
            </blockquote>
          </div>
          @endforeach


        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
  </div>
    </div>
    @endif

        <div class="col-md-12 col-lg-8 col-lg-offset-2 col-sm-12" style="margin-left:140px">
                             @if(sizeof($upcomingMeeting) >0)
                                <div class="white-box">
                                        <div class="panel panel-default">
                                        <div class="panel-heading">Upcoming Meetings</div>
                                            <div class="panel-body">
                                                @foreach($upcomingMeeting as $meet)
                                                    <div class="comment-center p-t-10">
                                                            <div class="comment-body">
                                                                    <div class="user-img"> 
                                                                        <img src="{{ asset('images/meeting.png') }}" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                                                                    </div>
                                                                    <div class="mail-contnet">
                                                                        <h5>{{$meet->name}}</h5><span class="time">{{ date('F d, Y', strtotime($meet->date)) }}</span>
                                                                        <br/><span class="mail-desc"> {{$meet->title}}</span>
                                                                        <a href="/agenda/{{$meet->id}}/{{$meet->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-success m-r-5"></i>Agenda</a>
                                                                        <a href="/invites/{{$meet->id}}/{{$meet->title}}" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-primary m-r-5"></i>Invite</a>
                                                                        <a href="/issues/{{$meet->id}}/{{$meet->title}}" class="btn-rounded btn btn-default btn-outline"><i class="ti-close text-danger m-r-5"></i> Issues</a>
                                                                  
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
                                          no upcomming meeting could found!
                                        </div>

                                @endif
                        </div>


        <!-- /.col -->
    </div>
</div>
@endsection