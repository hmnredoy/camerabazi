<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@include('vendor.dev-crud.partials.action_notification')
@inject('carbon', "Illuminate\Support\Carbon")

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <!-- left column -->
            <div class="col-md-8">
                <table>
                    <tr>
                        <td>Bids Remaining : {{$membershipData['memberBids']}} |</td>
                        <td>Skills Remaining : {{$membershipData['memberSkills']}} |</td>
                        <td>Coins Remaining : {{$membershipData['memberCoins']}} |</td>
                        <td>Amount Spent : {{$membershipData['amountSpent']}}</td>
                    </tr>
                </table>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('profile.update', $user->id)}}" enctype="multipart/form-data">
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
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="skill">Skills</label>
                                <select multiple class="form-control" id="skill" name="skills[]">
                                    @foreach($skills as $key => $item)
                                    <option value="{{$item->id}}">{{$key+1 .'. '.$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>--}}
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
                    <form role="form" method="POST" action="{{route('experience.store', $user->id)}}">
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
                    <form role="form" method="POST" action="{{route('experience.store', $user)}}">
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

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Portfolio</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('portfolio.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea class="form-control" rows="3" id="summary" name="summary"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload File</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Purchase History</h3>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Package</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Bids</th>
                            <th scope="col">Skills</th>
                            <th scope="col">Coins</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Expires On</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($membershipData['purchaseHistory'] as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->membership->title}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->bids}}</td>
                            <td>{{$item->skills}}</td>
                            <td>{{$item->coins}}</td>
                            <td>{{date_format($item->created_at, 'd-M-Y h:i a')}}</td>
                            <td>{{date_format($item->expire, 'd-M-Y h:i a')}}
                            @php $now  = $carbon->now(); @endphp
                                @if($now->diffInDays($item->expire, false) < 1)
                                    <br><small>Expired</small>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td rowspan="5">No Plan Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{--<div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('password.change', $user)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="text" class="form-control" name="new_password">
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="text" class="form-control" name="confirm_password">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>--}}
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/app.js')}}"></script>
