<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@include('vendor.dev-crud.partials.action_notification')

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Send offer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('client.offer.store', $bid->slug)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gender">Job Budget</label>
                                <input type="text" class="form-control" name="amount" value="{{$bid->amount}}">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gender">Delivery Timelines</label>
                                <input type="text" class="form-control" name="delivery_days" value="{{$bid->delivery_days}}">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gender">Message</label>
                                <textarea  class="form-control"  name="message" id="" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
