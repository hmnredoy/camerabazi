<?php

namespace Tests\Feature;

use App\Models\User;
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
}
