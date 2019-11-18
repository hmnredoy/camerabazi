<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        $this->createStarterPackage();

        $response = $this->post('/register',[

            'username' => 'Rakib',
            'mobile' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $freelancer->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);

        $this->assertDatabaseHas('users',['username'=>'Rakib','mobile' => '01539542041','role_id'=>$freelancer->id]);
        $response->assertRedirect('/freelancer/home');
    }

    /** @test */
    public function user_can_register_as_client()
    {
        $this->withoutExceptionHandling();

        $client = $this->createClientRole();

        $response = $this->post('/register',[

            'username' => 'rakib',
            'mobile' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $client->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);

        $this->assertDatabaseHas('users',['username'=>'rakib','role_id'=>$client->id]);
        $response->assertRedirect('/client/home');


    }



    /** @test */
    public function registered_user_must_have_a_profile()
    {
        $this->withoutExceptionHandling();


        $freelancer = $this->createFreelancerRole();
        $this->createStarterPackage();
        $response = $this->post('/register',[
            'id'  => 1,
            'username' => 'rakib',
            'mobile' => '01539542041',
            "email" => "client@gmail.com",
            "role" => $freelancer->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);

        $this->assertDatabaseHas('profile',['user_id'=>1]);
    }

    /** @test */
    public function password_can_be_changed()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);


        dump($user);

        $token = app('auth.password.broker')->createToken($user);

        $response = $this->post('password/reset',[
            'token' => $token,
            'email' => $user->email,
            'password' => '12345678',
            "password_confirmation" => "12345678"
        ]);

        dd($response);


        dd($user->refresh());

        // $2y$10$5g4bNdmiQUMBxd6KgNem1O3EqblqI9.VMbf.5mQhg2j.n7K.FeEJm

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
