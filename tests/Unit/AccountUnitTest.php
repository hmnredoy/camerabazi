<?php

namespace Tests\Unit;

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
}