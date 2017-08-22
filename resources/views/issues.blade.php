@extends('layouts.app')

@section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-6" >
            <div class="panel panel-default">
                <div class="panel-heading">Issues happened in Meeting</div>

                <div class="panel-body">
                    <form method="post" action="issues">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('person_in_charge_name') ? ' has-error' : '' }}">
                            <label for="person_in_charge_name" class="col-md-4 control-label">Person Responsible</label>

                            <div class="col-md-6">
                                <input id="person_in_charge_name" type="text" placeholder="Person Responsible" class="form-control" name="person_in_charge_name" value="{{ old('person_in_charge_name') }}" required autofocus>

                                @if ($errors->has('person_in_charge_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('person_in_charge_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                            <label for="contents" class="col-md-4 control-label">Issue in details</label>

                            <div class="col-md-6">
                            <textarea  id="issueInDetails" type="text" placeholder="Issue in details" class="form-control" name="issueInDetails" value="{{ old('issueInDetails') }}" required>
                            
                            </textarea>
                           

                                @if ($errors->has('issueInDetails'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('issueInDetails') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input class="form-control" name="meeting_id" value="1"><br>
                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id" ><br>
                        <button type="submit" class="btn btn-info btn-lg">Save</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-12"  @if(sizeof($issues) >0)>
        @foreach($issues as $issues) 
            <div  class="panel panel-info">
            <div class="panel-heading"> {{$issues->person_in_charge_name}} </div>
             <div class="panel-body">
             {{$issues->issueInDetails}} 
             </div>
              <div class="panel-footer">
            Created at: {{$issues->created_at}} 
             </div>
         </div>
        @endforeach
    
        </div @endif>
    </div>
</div>
@endsection
