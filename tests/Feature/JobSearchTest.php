<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobSearchTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_can_be_filter_by_price_range()
    {
        // given that we have some jobs
        $job1 = factory(Job::class)->create(['budget'=> 1000]);
        $job2 = factory(Job::class)->create(['budget'=> 1500]);
        $job3 = factory(Job::class)->create(['budget'=> 2000]);
        $job4 = factory(Job::class)->create(['budget'=> 300]);
        $job5 = factory(Job::class)->create(['budget'=>700]);

        // when we want to find job within price range

        $response = $this->get('freelancer/home?price[]');


        // we should see only those jobs that match the price range
    }


    /** @test */
    public function it_can_be_filter_by_category()
    {
        // given that we have some jobs
        $jobLaravel = factory(Job::class)->create();


        $phpCategory = factory(Category::class)->create(['name'=>'PHP']);

        $FrameworkCategory = factory(Category::class)->create([ 'name' => 'Framework']);

        $jobLaravel->categories()->attach($phpCategory->id);
        $jobLaravel->categories()->attach($FrameworkCategory->id);


        $jobJs = factory(Job::class)->create();

        $jobJs->categories()->attach($FrameworkCategory->id);



        $response = $this->get('freelancer/home?category[]='.$FrameworkCategory->id);

        $response->assertSee($jobLaravel->title);
        $response->assertDontSee($jobJs->title);


        // we should see only those jobs that match the price range
    }


    /** @test */
    public function it_can_be_filter_by_location()
    {

        $this->withoutExceptionHandling();





    }
}
