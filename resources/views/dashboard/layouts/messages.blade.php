@if(count($errors->all()) > 0 )

    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <h3>{{$error}}</h3>
        @endforeach
    </div>
    @endif

@if(session()->has('message') )

    <div class="alert alert-info">
        <p>{{session('message')}}</p>
        <i class="fa fa-close"></i>
    </div>
@endif


