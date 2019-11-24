<?php

namespace Tests\Unit;


use App\Models\FreelancerAccount;
use Tests\TestCase;
use App\Models\User;
use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountUnitTest extends TestCase
{

    use RefreshDatabase;

    /** @test */

    public function freelancer_role_exits()
    {
        $freelancer = new \App\Models\Role();
        $freelancer->name = 'freelancer';
        $freelancer->description='Looking For Job';
        $freelancer->save();

        $this->assertDatabaseHas('roles',['name'=>'freelancer']);
    }

    /** @test */
    public function  freelancer_has_an_account()
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

        $registeredUser->refresh();

        $this->assertInstanceOf(FreelancerAccount::class,$registeredUser->account);
    }
}