<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Job;
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
}
