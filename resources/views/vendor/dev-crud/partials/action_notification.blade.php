@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style-type: none;">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success'))
    <div class="alert alert-success" style="margin: 10px">
       {!!  Session::get('success') !!}
   </div>
@endif

@if(Session::get('warning'))
   <div class="alert alert-warning" style="margin: 10px">
      {!!  Session::get('warning') !!}
  </div>
@endif

@if(Session::get('error'))
    <div class="alert alert-danger" style="margin: 10px">
        {!!  Session::get('error') !!}
    </div>
@endif
