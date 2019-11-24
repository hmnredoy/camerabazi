@extends('layouts.main');

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Project Name</th>
            <th scope="col">My Bids</th>
            <th scope="col">Bids</th>
            <th scope="col">Bid End in</th>
            <th scope="col">Avg Bid</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bids as $bid)
            <tr>
                <th scope="row"> <a href="{{$bid->job->path()}}">{{$bid->job->title}}</a>  </th>
                <td>{{$bid->amount}}</td>
                <td>{{$bid->job->bids()->count()}}</td>
                <td>{{$bid->job->expire->diffForHumans()}}</td>
                <td>{{$bid->job->getAvgBid()}}</td>

            </tr>
        @endforeach

        </tbody>
    </table>

@endsection