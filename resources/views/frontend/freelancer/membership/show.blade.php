<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@include('vendor.dev-crud.partials.action_notification')

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Membership Plans</h3>
                    </div>
                    <div class="card-body">
                        @foreach($memberships as $membership)
                            <form role="form" method="POST" action="{{route('membership.buy', $membership->id)}}">
                                @csrf
                                {{$membership->title}}
                                <button type="submit" class="btn btn-xs btn-success">BUY</button>
                            </form>
                            <hr>
                        @endforeach
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{--<form role="form" method="POST" action="{{route('profile.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select class="form-control" id="location" name="location">
                                    @foreach($locations as $item)
                                        <option value="{{$item->id}}">{{$item->location}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="skill">Skills</label>
                                <select multiple class="form-control" id="skill" name="skill[]">
                                    @foreach($skills as $key => $item)
                                        <option value="{{$item->id}}">{{$key+1 .'. '.$item->skill}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"  name="image"  class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>--}}
                </div>
            </div>
        </div>
    </div>
</section>
