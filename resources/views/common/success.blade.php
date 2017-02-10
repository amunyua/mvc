@if(Session::has('status'))
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ Session::get('status') }}
    </div>
@endif