@extends('layouts.main');

@section('content')
    @foreach($jobs as $job)
    {{ $job->title  }}

        <a href="{{$job->path()}}/bid" > Bid </a>
    @endforeach
@endsection