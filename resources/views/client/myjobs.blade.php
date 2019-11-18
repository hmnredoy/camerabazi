@extends('layouts.main')

@section('content')
    <br>
  @foreach($jobs as $key => $job)
      <a href="{{route('job.bids', $job->id)}}">{{ $key+1}}. {{ $job->title }}</a>
    <br>
  @endforeach
@endsection
