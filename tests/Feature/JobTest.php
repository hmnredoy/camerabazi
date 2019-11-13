<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Location;
use App\Models\User;
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

        $this->assertDatabaseHas('jobs',['title' => 'Tenetur natus vero tenetur adipisci velit.']);



    }
}
