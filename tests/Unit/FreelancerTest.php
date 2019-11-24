<?php

namespace Tests\Unit;

use App\Models\Bid;
use App\Models\Job;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FreelancerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function he_can_get_his_bids()
    {
        $this->withoutExceptionHandling();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id]);
        $job1 = factory(Job::class)->create();
        $myBid1 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id]);
        $job2 = factory(Job::class)->create();
        $myBid2 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id]);
        $this->actingAs($freelancer);

        $job1->addBid($myBid1);
        $job2->addBid($myBid2);



        $this->assertTrue($freelancer->bids->contains($myBid1));
        $this->assertTrue($freelancer->bids->contains($myBid2));


    }


}
