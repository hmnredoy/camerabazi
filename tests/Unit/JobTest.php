<?php

namespace Tests\Unit;

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
}
