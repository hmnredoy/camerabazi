<?php

namespace Tests\Feature;

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

}
