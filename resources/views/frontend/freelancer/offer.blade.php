<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@include('vendor.dev-crud.partials.action_notification')
@inject('bidStatus', "App\Models\Enums\BidStatus")

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Offered</h3>
                    </div>
                    <div class="card-body">
                        <h2>{{$bid->job->title}}</h2>
                        Updated Budget : <p>{{$offer->amount}}</p>
                        Status : <p>{{$bidStatus->getKey($offer->bid->status)}}</p>
                        Message : <p>{{$offer->message}}</p>

                        @if($offer->bid->status != $bidStatus::Accepted && $offer->bid->status != $bidStatus::Rejected)
                        <form role="form" method="POST" action="{{route('freelancer.offer.decision', $bid)}}">
                            @csrf
                            <button type="submit" class="btn btn-success" name="decision" value="{{$bidStatus::Accepted }}">Accept</button>
                            <button type="submit" class="btn btn-danger" name="decision" value="{{$bidStatus::Rejected }}">Reject</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
