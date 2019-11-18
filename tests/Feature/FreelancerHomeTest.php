<?php

namespace Tests\Feature;

use App\Models\Bid;
use App\Models\Job;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FreelancerHomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function freelancer_can_visit_a_job()
    {
        $this->withoutExceptionHandling();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id]);
        $job = factory(Job::class)->create();

        $this->actingAs($freelancer);

        $this->get($job->path())->assertSee($job->title);



    }

    /** @test */

    public function he_can_show_his_active_jobs()
    {

        $this->withoutExceptionHandling();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id]);

        $job1 = factory(Job::class)->create();
        $job2 = factory(Job::class)->create();

        $myBid1 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job1->id]);
        $myBid2 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job2->id]);


        $this->actingAs($freelancer);





        $this->post('jobs/'.$job1->id.'/bids/'.$myBid1->id.'/approved');
        $this->post('jobs/'.$job2->id.'/bids/'.$myBid2->id.'/approved');



        $this->assertTrue($freelancer->getActiveJobs()->contains($job1));


    }

    /** @test */
    public function he_can_show_his_all_proposals()
    {

        $this->withoutExceptionHandling();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id]);


        $job1 = factory(Job::class)->create();
        $job2 = factory(Job::class)->create();
        $job3 = factory(Job::class)->create();



        $myBid1 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job1->id]);
        $myBid2 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job2->id]);
        $myBid3 = factory(Bid::class)->create();



        $this->actingAs($freelancer);





        $respone = $this->get('/freelancer/submitted-bids');


        $respone->assertSee($myBid1->amount);
        $respone->assertSee($myBid2->amount);
        $respone->assertDontSee($myBid3->amount);
    }

    /** @test */

    public function he_can_show_his_canceled_jobs()
    {

        $this->withoutExceptionHandling();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id]);

        $job1 = factory(Job::class)->create();
        $job2 = factory(Job::class)->create();

        $myBid1 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job1->id]);
        $myBid2 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job2->id]);


        $this->actingAs($freelancer);





        $this->post('jobs/'.$job1->id.'/bids/'.$myBid1->id.'/approved');

        $this->post('jobs/'.$job2->id.'/bids/'.$myBid2->id.'/cancel');



        $this->assertTrue($freelancer->getCanceledJobs()->contains($job2));
        $this->assertFalse($freelancer->getCanceledJobs()->contains($job1));


    }


    /** @test */

    public function he_can_show_his_succeeded_jobs()
    {

        $this->withoutExceptionHandling();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id]);

        $job1 = factory(Job::class)->create();
        $job2 = factory(Job::class)->create();

        $myBid1 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job1->id]);
        $myBid2 = factory(Bid::class)->create(['freelancer_id'=>$freelancer->id,'job_id'=>$job2->id]);


        $this->actingAs($freelancer);




        $this->post('jobs/'.$job1->id.'/bids/'.$myBid1->id.'/succeeded');



        $this->assertTrue($freelancer->getSucceededJobs()->contains($job1));


    }

    // make sure bid endpoint works

}
