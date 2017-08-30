@extends('layouts.app')

@section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-6" >
            <div class="panel panel-default">
                <div class="panel-heading">Register new Attendee</div>

                <div class="panel-body">
                    <form method="post" action="attenda">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                            <label for="fullname" class="col-md-4 control-label">Full name</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" placeholder="full name of attenda" class="form-control" name="fullname" value="{{ old('fullname') }}" required autofocus>

                                @if ($errors->has('fullname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="email address" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" placeholder="phone number" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" placeholder="address eg(kgt 20,kigali rwanda)" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id" ><br />
                        <div class="col-md-6">
                        <br />
                       <center> <button type="submit" class="btn btn-info btn-lg">Save</button> </center>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-12"  @if(sizeof($attenda) >0)>
        @foreach($attenda as $attenda) 
            <div  class="panel panel-default">
            <div class="panel-heading"> List of Attendants </div>
             <div class="panel-body">
             <table class="table">
               <thead> <tr>
                 <th>Full name</th> <th>Email Address</th> <th>Other address</th> <th>Phone number</th> <th colspan="2">Option</th>
                  </tr>
                  <tbody>
                  <tr>
                 <td>{{$attenda->fullname}} </td> <td>{{$attenda->email}} </td> <td>{{$attenda->phone}} </td> <td>{{$attenda->address}} </td><td><a href="attenda/delete/{{$attenda->id}}" class="btn btn-danger"> Delete</a></td>
                 <td><a href="attenda/edit/{{$attenda->id}}" class="btn btn-info"> Edit</a></td>
                  </tr>
                  </tbody>
               </thead>
             </table>
             </div>
              <!-- <div class="panel-footer">

             </div> -->
         </div>
        @endforeach
    
        </div @endif>
    </div>
</div>
@endsection
