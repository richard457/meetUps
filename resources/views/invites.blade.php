@extends('layouts.app')

@section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">Invite people in meeting </div>

                <div class="panel-body">
            
          <div class="col-md-12"  @if(sizeof($invites) >0)>
       
            <form method="post" action="invites">
               {{ csrf_field() }}
            <div  class="panel panel-default">
            <div class="panel-heading"> List of invites </div>
          
             <div class="panel-body">

                    <table class="table">
                    <thead> <tr>
                        <th>Invite</th>
                        <th>Email Address</th> <th>Other address</th> <th>Phone number</th> <th colspan="2">Option</th>
                        </tr>
                           @foreach($invites as $invites) 
                        <tbody>
                        <tr>
                        <td>{{$invites->fullname}} </td>  <td>{{$invites->fullname}} </td> <td>{{$invites->email}} 
                         <input id="email" type="email" placeholder="email address" class="form-control" name="email[]" value="{{$invites->email}}" required>
                         </td> <td>{{$invites->phone}} </td> <td>{{$invites->address}} </td>
                        <td><button type="submit" class="btn btn-info btn-lg">Invite</button></td>
                        </tr>
                        </tbody>
                         @endforeach
                    </thead>
                    </table>
             </div>
             
          </div>
        </div>
     </form>

       
    
        </div @endif>
    </div>

                    
                </div>
            </div>
        </div>
       
</div>
@endsection
