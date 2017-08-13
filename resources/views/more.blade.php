

    @extends('layouts.app')

    @section('content')
        <div class="col-12">
            <div style="padding: 4em;margin-left: 445px;" class="col-4">
                <form action="/more">
                    <header class="card-header col-4">Arising issue</header>
                    <textarea name="arising_isue" id="issue" cols="120" rows="10">

                    </textarea>
                    <button class="btn btn-outline-info btn-lg">Save Meeting</button>
                </form>
            </div>
        </div>
    @endsection
