<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
