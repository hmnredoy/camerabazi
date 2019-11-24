<?php

namespace Tests\Unit;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Enums\JobStatus;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    use RefreshDatabase;


   /** @test */

   public function it_has_a_path()
   {
       $job = factory(Job::class)->create();

       $this->assertEquals('/jobs/'.$job->id,$job->path());
   }



   /** @test */
   public function it_has_many_categories()
   {

       $this->withExceptionHandling();

        $job = factory(Job::class)->create();

        $category1 = factory(Category::class)->make();
        $category2 = factory(Category::class)->make();


       $job->addCategory($category1);
       $job->addCategory($category2);


       $this->assertTrue($job->categories->contains($category1));
       $this->assertTrue($job->categories->contains($category2));


   }


   /** @test */
   public function it_can_add_bid()
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
    public function it_can_mark_a_bid_as_accepted()
    {
        // create a job
        // add some bid
        // make sure it can add a bid as accepted

        $job = factory(Job::class)->create();

        $bid1 = factory(Bid::class)->create(['job_id'=>$job->id]);
        $bid2 = factory(Bid::class)->create(['job_id'=>$job->id]);
        $job->addBid($bid1);
        $job->addBid($bid2);

        $this->assertEquals(false,$bid1->is_accepted);

        $job->markAccepted($bid1);

        $winnerBid = $job->getAcceptedBid();


        $this->assertEquals(true,$winnerBid->is_accepted);

    }


    /** @test */
    public function after_created_its_status_is_submitted()
    {
        $clientRole = $this->createClientRole();
        $client = factory(User::class)->create(['role_id'=>$clientRole->id]);
        $this->actingAs($client);

        $category1 = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();
        $location = factory(Location::class)->create();


        $data = [
            'id' => 1,
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

        $job = Job::find(1);


        $this->assertEquals(JobStatus::submitted,$job->status);
    }

}
