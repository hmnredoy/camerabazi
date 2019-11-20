<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Enums\JobStatus;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientHomeTest extends TestCase
{
    use RefreshDatabase;


/** @test */
public function can_see_post_job_link()
{
    $this->withoutExceptionHandling();

    $clientRole = $this->createClientRole();
    $client = factory(User::class)->create(['role_id'=>$clientRole->id]);
    $this->actingAs($client);

    $this->get('/client/home')->assertSee('Post A Job');

}

    /** @test */
    public function can_see_his_posted_job()
    {
        $this->withoutExceptionHandling();

        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);

        $job1 = factory(Job::class)->create(['user_id'=>$client->id]);
        $job2 = factory(Job::class)->create(['user_id'=>$client->id]);
        $job3 = factory(Job::class)->create(['user_id'=>$client->id]);

        $this->actingAs($client);

        $this->get('/client/jobs')->assertSee($job1->title);
        $this->get('/client/jobs')->assertSee($job2->title);



    }


    /** @test */
    public function can_see_ongoing_posted_job()
    {
        $this->withoutExceptionHandling();

        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);

        $job1 = factory(Job::class)->create(['user_id'=>$client->id]);
        $job2 = factory(Job::class)->create(['user_id'=>$client->id]);


        $yesterday = Carbon::yesterday();
        $alsoY2K = Carbon::create(1999, 12, 31, 24);


        $jobexpired = factory(Job::class)->create(['user_id'=>$client->id,'expire'=>$yesterday]);
        $jobexpired2 = factory(Job::class)->create(['user_id'=>$client->id,'expire'=>$alsoY2K]);


        $this->actingAs($client);

        $this->get('/client/ongoing-jobs')->assertSee($job1->title);
        $this->get('/client/ongoing-jobs')->assertSee($job2->title);
        $this->get('/client/ongoing-jobs')->assertDontSee($jobexpired->title);
        $this->get('/client/ongoing-jobs')->assertDontSee($jobexpired2->title);





    }

    /** @test */
    public function cant_see_blocked_post()
    {
        $this->withoutExceptionHandling();

        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);

        $job1 = factory(Job::class)->create(['user_id'=>$client->id]);
        $job2 = factory(Job::class)->create(['user_id'=>$client->id]);
        $job3 = factory(Job::class)->create(['user_id'=>$client->id]);

        $job3->status = JobStatus::blocked;
        $job3->save();





        $this->actingAs($client);

        $this->get('/client/ongoing-jobs')->assertSee($job1->title);
        $this->get('/client/ongoing-jobs')->assertSee($job2->title);
        $this->get('/client/ongoing-jobs')->assertDontSee($job3->title);
//




    }
}
