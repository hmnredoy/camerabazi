@extends('layouts.main');

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Project Name</th>
            <th scope="col">Bids</th>
            <th scope="col">Avg Bids</th>
            <th scope="col">Projects End in</th>

        </tr>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <th scope="row"> <a href="">{{$job->title}}</a>  </th>
                <td>{{$job->bids_count}}</td>
                <td>{{$job->getAvgBid()}}</td>
                <td>{{$job->expire->diffForHumans()}}</td>


            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
