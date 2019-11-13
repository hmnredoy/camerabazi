<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function user_can_register_as_freelancer()
    {
        $this->withoutExceptionHandling();

        $freelancer = $this->createFreelancerRole();

        $this->post('/register',[
            "firstname" => "Rodion",
            'lastname' => 'Rakib',
            'contact' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $freelancer->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);

        $this->assertDatabaseHas('users',['firstname'=>'Rodion','contact' => '01539542041','role_id'=>$freelancer->id]);

    }

    /** @test */
    public function user_can_register_as_client()
    {
        $this->withoutExceptionHandling();

        $client = $this->createFreelancerRole();

        $this->post('/register',[
            "firstname" => "Rodion",
            'lastname' => 'Rakib',
            'contact' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $client->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);

        $this->assertDatabaseHas('users',['firstname'=>'Rodion','role_id'=>$client->id]);

    }

    /** @test */
    public function client_can_visit_his_homepage()
    {
        $this->withoutExceptionHandling();


        $client = $this->createClientRole();

        $response = $this->post('/register',[
            "firstname" => "Rodion",
            'lastname' => 'Rakib',
            'contact' => '01539542041',
            "email" => "client@gmail.com",
            "role" => $client->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);

       $response->assertRedirect('/client/home');

    }













    public function createFreelancerRole()
    {
        $freelancer = new \App\Models\Role();
        $freelancer->name = 'freelancer';
        $freelancer->description='Looking For Job';
        $freelancer->save();

        return $freelancer;


    }

    public function createClientRole()
    {
        $freelancer = new \App\Models\Role();
        $freelancer->name = 'client';
        $freelancer->description='Looking For Freelancer';
        $freelancer->save();

        return $freelancer;


    }

}
