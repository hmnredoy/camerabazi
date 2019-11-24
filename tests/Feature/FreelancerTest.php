<?php

namespace Tests\Feature;

use App\Models\Package;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FreelancerTest extends TestCase
{
    use RefreshDatabase;

   /** @test */

   public function he_has_a_package_type()
    {
        $freelancerRole = $this->createFreelancerRole();
        $package = $this->createStarterPackage();
        $freelancer = factory(User::class)->create(['role_id'=>$freelancerRole->id,'package_id'=>$package->id]);


        $this->assertInstanceOf(Package::class,$freelancer->package);

    }


    /** @test */
    public function when_registered_as_freelancer_he_will_get_a_starter_package()
    {
        $this->withoutExceptionHandling();
        $this->createStarterPackage();

        $freelancerRole = $this->createFreelancerRole();
        $package = $this->createStarterPackage();
        $response = $this->post('/register',[
            'id'  => 1,
            'username' => 'Rakib',
            'mobile' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $freelancerRole->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);



         $registeredUser = User::find(1);




         $this->assertInstanceOf(Package::class,$registeredUser->package);
         $this->assertEquals($registeredUser->package->bid_per_month ,15);
    }

    /** @test */
    public function only_freelancer_has_package()
    {
        $this->withoutExceptionHandling();

        $client = $this->createClientRole();
        $package = $this->createStarterPackage();
        $response = $this->post('/register',[
            'id'  => 1,
            'username' => 'Rakib',
            'mobile' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $client->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);



        $registeredUser = User::find(1);


        $this->assertEquals(null,$registeredUser->package);
    }


    /** @test */
    public function when_registered_as_freelancer_he_will_get_an_account()
    {
        $this->withoutExceptionHandling();
        $this->createStarterPackage();

        $freelancerRole = $this->createFreelancerRole();
        $package = $this->createStarterPackage();
        $response = $this->post('/register',[
            'id'  => 1,
            'username' => 'Rakib',
            'mobile' => '01539542041',
            "email" => "freelancer@gmail.com",
            "role" => $freelancerRole->id,
            "password" => "freelancer@gmail.com",
            "password_confirmation" => "freelancer@gmail.com"
        ]);



        $registeredUser = User::find(1);






        $this->assertEquals($registeredUser->account->bid ,15);
    }


}
