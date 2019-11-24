@extends('layouts.main');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form method="post" action={{route('profile.changePassword')}}>
                    @csrf
                    <label>Current Password</label>
                    <div class="form-group pass_show">
                        <input  name="old_password" type="password" value="faisalkhan@123" class="form-control" placeholder="Current Password">
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show">
                        <input  name="password" type="password" value="faisal.khan@123" class="form-control" placeholder="New Password">
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show">
                        <input  name="password_confirmation" type="password" value="faisal.khan@123" class="form-control" placeholder="Confirm Password">
                    </div>
                    <button type="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection