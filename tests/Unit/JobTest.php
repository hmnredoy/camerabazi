<?php

namespace Tests\Unit;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Job;
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
}
