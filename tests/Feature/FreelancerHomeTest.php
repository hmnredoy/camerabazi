<?php

namespace Tests\Feature;

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

}
