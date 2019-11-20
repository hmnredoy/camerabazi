@extends('layouts.main')

@section('content')
    <br>
    @foreach($jobs as $job)
    {{ $job->title  }}
        <a href="{{$job->path()}}/bid" > Bid </a><br>
    @endforeach
@endsection
