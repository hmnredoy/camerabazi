@extends('layouts.main')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
    <form method="post" action="/jobs">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Budget</label>
            <input type="number" name="budget" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Expire Date</label>
            <input type="date" name="expire" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect2">Category</label>
            <select name="categories[]" multiple class="form-control" id="exampleFormControlSelect2">
                 @foreach($categories as $category)
                    <option value="{{$category->id}}" >{{$category->name}}</option>
                 @endforeach


            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Location</label>
            <select name="location_id"  class="form-control" id="exampleFormControlSelect2">
                @foreach($locations as $location)
                    <option value="{{$location->id}}" >{{$location->title}}</option>
                @endforeach


            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Job Details</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            </div>
        </div>
    </section>

@endsection



