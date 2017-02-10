@if (Session::has('success'))
    <br>
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"> × </button>
        <i class="fa fa-fw fa-check"></i><strong>Success </strong> {{ Session::get('success') }}
    </div>
    <br>

@endif
@if (Session::has('warning'))
    <br>
    <div class="alert alert-warning" role="alert">
        <button class="close" data-dismiss="alert"> × </button>
        <i class="fa fa-fw fa-check"></i><strong>Warning! </strong> {{ Session::get('warning') }}
    </div>
    <br>

@endif

@if(count($errors) > 0)
    <br>
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"> × </button>
        <i class="fa fa-fw fa-times fa-x"></i><strong>Error:</strong><ul>
        @foreach($errors->all()  as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
    @endif

@if (Session::has('failed'))
    <br>
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"> × </button>
        <i class="fa fa-fw fa-remove">  </i><strong>Failed! </strong> {{ Session::get('failed') }}
    </div>
    <br>

@endif