@extends('layouts.app') @section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">

                    <div class="col-md-12" @if(sizeof($invites)>0)>

                        <form method="post" action="invites">
                            {{ csrf_field() }}
                            <div class="panel panel-default">
                                <div class="panel-heading"> List of invites </div>

                                <div class="panel-body">
                                    <button type="submit" class="btn btn-info btn-lg">Invite</button>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Invite</th>
                                                <th>Email Address</th>
                                                <th>Other address</th>
                                                <th>Phone number</th>
                                                <th colspan="2">Option</th>
                                            </tr>
                                            @foreach($invites as $invites)
                                            <tbody>
                                                <tr>
                                                    <td><input type='checkbox' name="check[]" value="{{$invites->id}}, {{$invites->email}}"></td>
                                                    <td>{{$invites->fullname}} </td>
                                                    <td>{{$invites->fullname}} </td>
                                                    <td>{{$invites->email}}
                                                    </td>
                                                    <td>{{$invites->phone}} </td>
                                                    <td>{{$invites->address}} </td>

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
@endsection