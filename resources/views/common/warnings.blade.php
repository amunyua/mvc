@if(count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-warning">
        <strong>Whoops! Something went wrong!</strong>
        <button class="close" data-dismiss="alert">&times;</button>
        <br><br>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif