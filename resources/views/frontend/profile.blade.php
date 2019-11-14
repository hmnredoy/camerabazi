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
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
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
                    </form>
                </div>
                <!-- /.card -->

                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Experience</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('experience.store')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="title_or_country">
                            </div>
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" class="form-control" name="institute">
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="started_at">
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="ended_at">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                            <input type="hidden" name="type" value="{{\App\Models\Enums\ExperienceTypes::company}}">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Education</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('experience.store')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Institute</label>
                                <input type="text" class="form-control" name="institute">
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="started_at">
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="ended_at">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" name="title_or_country">
                            </div>
                            <input type="hidden" name="type" value="{{\App\Models\Enums\ExperienceTypes::education}}">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/app.js')}}"></script>
