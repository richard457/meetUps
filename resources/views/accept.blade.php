<html>
<header>
    <link href="{{ asset('/css/paper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</header>
<body>
<div class="container-fluid">
    <div class="card-header"><p class="offset-5">Accept Invitation
        <p></p></div>
    <div class="card">
        <div class="panel-body">
            <span class="card-header offset-5">Add your Own Agenda</span>
            <form method="post" action="agenda">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" placeholder="title of agenda" class="form-control" name="title"
                               value="{{ old('title') }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                    <label for="contents" class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <input id="contents" type="text" placeholder="contents of agenda" class="form-control"
                               name="contents" value="{{ old('contents') }}" required>

                        @if ($errors->has('contents'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('contents') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <input class="form-control" type="hidden" namep="meeting_id" value="{{$meeting_id}}"><br>
                <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id"><br>
                <button type="submit" class="btn btn-info btn-lg">Save Agenda</button>
            </form>

        </div>
    </div>

    {{--possiblity to schedule meeting--}}
    <div class="card">
        <form>

            <input type="date">
        </form>
    </div>
    <div></div>

</div>
</body>
</html>