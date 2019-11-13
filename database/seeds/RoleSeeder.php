<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $freelancer = new Role();
        $freelancer->name = 'freelancer';
        $freelancer->description='Looking For Job';
        $freelancer->save();

        $client = new Role();
        $client->name = 'client';
        $client->description = 'Looking For Freelancer';
        $client->save();


        $admin = new \App\Models\Role();
        $admin->name = 'admin';
        $admin->description = 'Super Admin';
        $admin->save();


    }
}
