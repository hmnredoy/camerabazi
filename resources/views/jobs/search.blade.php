@extends('layouts.main');

@section('content')
    @foreach($jobs as $job)
        {{$job->title}}
    @endforeach

@endsection