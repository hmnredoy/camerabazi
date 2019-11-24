<?php

namespace Tests\Feature;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use App\Models\Enums\JobStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function client_can_create_job()
    {
        $this->withoutExceptionHandling();

        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);
        $this->actingAs($client);

        $category1 = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();
        $location = factory(Location::class)->create();


        $data = [
            'location_id'=> $location->id,
            'title' => "Tenetur natus vero tenetur adipisci velit.",
            'description' => "Qui placeat aut rem et ut quod possimus. Velit modi voluptatem harum velit repellat consectetur. Et et voluptatum iure animi. Quaerat quis id veritatis sit ut pariatur eius.",
            'budget'=> 2300,
            'expire' => '2019-12-12 12:59:04',
            'categories' => [
                 $category1->id,
                $category2->id,
            ]

            ];

        $this->post('/jobs',$data);

        $this->assertDatabaseHas('jobs',['title' => 'Tenetur natus vero tenetur adipisci velit.']);






    }

    /** @test */
    public function freelancer_can_bid_to_a_job()
    {
        $job = factory(Job::class)->create();

        $freelancerRole = $this->createFreelancerRole();
        $freelancer1 = factory(User::class)->create(['role_id'=>$freelancerRole->id]);
        $freelancer2 = factory(User::class)->create(['role_id'=>$freelancerRole->id]);


        $bid1 = factory(Bid::class)->create(['freelancer_id'=>$freelancer1->id,'job_id'=>$job->id]);

        $bid2 = factory(Bid::class)->create(['freelancer_id'=>$freelancer2->id,'job_id'=>$job->id]);


        $job->addBid($bid1);
        $job->addBid($bid2);


        $this->assertCount(2,$job->bids);



    }

    /** @test */
    public function client_can_cancel_a_job()
    {
        $this->withoutExceptionHandling();

        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);
        $job = factory(Job::class)->create(['user_id'=>$client->id]);
        $this->actingAs($client);

        $this->post($job->path().'/cancel');

        $this->assertDatabaseHas('jobs',['status'=>JobStatus::cancelled]);
    }
}
