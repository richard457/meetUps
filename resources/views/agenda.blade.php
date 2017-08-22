@extends('layouts.app')

@section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-6" >
            <div class="panel panel-default">
                <div class="panel-heading">Agenda of Meeting</div>

                <div class="panel-body">
                    <form method="post" action="agenda">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" placeholder="title of agenda" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                            <label for="contents" class="col-md-4 control-label">Contents</label>

                            <div class="col-md-6">
                                <input id="contents" type="text" placeholder="contents of agenda" class="form-control" name="contents" value="{{ old('contents') }}" required>

                                @if ($errors->has('contents'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contents') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input class="form-control" name="meeting_id" value="1"><br>
                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id" ><br>
                        <button type="submit" class="btn btn-info btn-lg">Agenda</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-12"  @if(sizeof($agenda) >0)>
        @foreach($agenda as $agenda) 
            <div  class="panel panel-default">
            <div class="panel-heading"> {{$agenda->title}} </div>
             <div class="panel-body">
             {{$agenda->contents}} 
             </div>
              <div class="panel-footer">
            Created at: {{$agenda->created_at}} 
             </div>
         </div>
        @endforeach
    
        </div @endif>
    </div>
</div>
@endsection
