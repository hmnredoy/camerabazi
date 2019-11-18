<?php

namespace Tests\Feature;

use App\Models\Bid;
use App\Models\Job;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BidTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function one_freelancer_cant_bid_twice_in_a_job()
    {
        $job = factory(Job::class)->create();

        $freelancer = factory(User::class)->create();

        $this->actingAs($freelancer);

        $this->post($job->path().'/bid',[
            'amount' => '1200',
            'delivery_days' => '3',
            'description'=> 'like ie',
            'job_id' => $job->id,
            'freelancer_id' => $freelancer->id
        ]);

        $this->post($job->path().'/bid',[
            'amount' => '1200',
            'delivery_days' => '3',
            'description'=> 'like ie',
            'job_id' => $job->id,
            'freelancer_id' => $freelancer->id
        ]);

        $this->assertCount(1,$job->bids);




    }

    /** @test */
    public function a_client_can_accept_one_proposal()
    {
        $freelancerRole = $this->createFreelancerRole();
        $freelancer1 = factory(User::class)->create(['role_id'=>$freelancerRole->id]);

        $freelancer2 = factory(User::class)->create(['role_id'=>$freelancerRole->id]);

        // suppose you are client
        // you posted a job
        // many freelancer bid against your job
        // among all bid you can accept a bid and assign the freelancer the job

        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);


        $job = factory(Job::class)->create(['user_id'=>$client->id]);

        $freelancer1Bid = factory(Bid::class)->create(['freelancer_id'=>$freelancer1->id,'job_id'=>$job->id]);
        $freelancer2Bid = factory(Bid::class)->create(['freelancer_id'=>$freelancer2->id,'job_id'=>$job->id]);

        $job->addBid($freelancer1Bid);
        $job->addBid($freelancer2Bid);

        $this->assertCount(2,$job->bids);



        $job->markAccepted($freelancer2Bid);

        $winnerBid = $job->getAcceptedBid();


        $this->assertEquals($freelancer2Bid->amount,$winnerBid->amount);
        $this->assertEquals($winnerBid->freelancer_id,$freelancer2->id);





    }

    /** @test */
    public function bid_can_be_accepted()
    {

        $this->withoutExceptionHandling();

        $job = factory(Job::class)->create();
        $bid1 = factory(Bid::class)->create(['job_id'=>$job->id]);
        $bid2 = factory(Bid::class)->create(['job_id'=>$job->id]);
        $job->addBid($bid1);
        $job->addBid($bid2);

        $this->post('/jobs/'.$job->id.'/bids/'.$bid2->id.'/approved');

        $this->assertEquals($job->getAcceptedBid()->id,$bid2->id);
    }

}
