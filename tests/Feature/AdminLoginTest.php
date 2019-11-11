<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_view_login_page()
    {
        $this->withoutExceptionHandling();
        
        $this->get(route('login'))->assertStatus(200);
    }
}
