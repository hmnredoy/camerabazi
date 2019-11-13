@if (count($errors??[]) > 0)
    {{--<div class="alert alert-danger" style="margin: 10px">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>--}}

    <div class="alert alert-danger">
        <ul style="list-style-type: none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
        </ul>
    </div>

@endif

@if(Session::get('success'))
    <div class="alert alert-success" style="margin: 10px">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::get('warning'))
    <div class="alert alert-warning" style="margin: 10px">
        {{ Session::get('warning') }}
    </div>
@endif

@if(Session::get('error'))
    <div class="alert alert-danger" style="margin: 10px">
        {{ Session::get('error') }}
    </div>
@endif
