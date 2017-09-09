@extends('layouts.app')

@section('content')
    <div class="container" style="padding:1em;">
        <div class="row">
       
         

            <div class="col-md-12" style="min-width:750px;" @if(sizeof($meetingstatement) >0)>

   <div class="panel panel-primary">
                <div class="panel-heading">Meeting #{{$meeting_id}}</div>

                <div class="panel-body">
                @foreach($meetingstatement as $meet)
                    <li style="padding:1em;display:block;background:#fff;margin-bottom:10px;">
                        <span id="meetting"> {{$meet->title}} </span>
                      
                     <div>
                      <div class="panel-footer">
                                                Starting date: {{$meet->date}} 
                        </div>
                        <hr />
                       <div class="panel panel-info"  @if(sizeof($meetingAgender) >0)>
                        <div class="panel-heading">Agenda</div>

                                    <div class="panel-body">
                                    
                                             @foreach($meetingAgender as $agenda) 
                                                <div  class="panel panel-default">
                                                <div class="panel-heading"> {{$agenda->title}} </div>
                                                <div class="panel-body">
                                                {{$agenda->contents}} 

                                                <hr />
                                                <div class="container"  @if(sizeof($agenderComment) >0)>
                                                                <div class="row">
                                                                        <div class="col-sm-12">
                                                                        <h5>Agenda comments</h5>
                                                                        </div><!-- /col-sm-12 -->
                                                                </div><!-- /row -->
                                                                @foreach($agenderComment as $agenda) 
                                                                <div class="row">
                                                                <div class="col-sm-1">
                                                                <div class="thumbnails">
                                                                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                                                </div><!-- /thumbnail -->
                                                                </div><!-- /col-sm-1 -->

                                                                <div class="col-sm-8">
                                                                <div class="panels panel-default">
                                                                <div class="panel-heading">
                                                                <strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
                                                                </div>
                                                                <div class="panel-body" >
                                                            
                                                                </div><!-- /panel-body -->
                                                                </div><!-- /panel panel-default -->
                                                                </div><!-- /col-sm-5 -->

                                                                </div><!-- /row -->
                                                                 @endforeach

                                                                </div><!-- /container -->
                                                </div @endif>
                                                <div class="panel-footer" style="height:100px">
                                           <form method="post" action="comment/posts">
                                              {{ csrf_field() }}
                                               <input type="text" name="agenda" hidden="hidden" value="{{$agenda->id}}">
                                               <input type="text" name="commenter" hidden="hidden" value="{{$invitingId}}">
                                                 <textarea  type="text" placeholder="Type you comments ...." rows="4" class="form-control col-sm-12 col-md-10 col-lg-10" name="comment" required> </textarea>
                                                                &nbsp;&nbsp;&nbsp;<button type="submit" id="button" class="btn btn-info btn-lg">Post</button> 
                                             </form>
                                             </div>
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
@endsection


