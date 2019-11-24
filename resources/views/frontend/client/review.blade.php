<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@include('vendor.dev-crud.partials.action_notification')

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <!-- left column -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="POST" action="{{route('review.store', $job->slug)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="skill">Rate</label>
                                <select class="form-control" id="rating" name="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender">Comment</label>
                                <textarea class="form-control" name="comment" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
