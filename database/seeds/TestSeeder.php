<?php

use App\Models\Enums\ExperienceTypes;
use App\Models\Enums\JobStatus;
use App\Models\Enums\SkillToolTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_plans')->delete();
        /*DB::table('jobs')->delete();
        DB::table('locations')->delete();
        DB::table('categories')->delete();
        DB::table('users')->delete();
        DB::table('profile')->delete();*/
        DB::table('skill_tools')->delete();
        DB::table('user_skill_tool')->delete();
        /*DB::table('portfolio')->delete();
        DB::table('experiences')->delete();*/

/*        DB::table('users')->insert([
            [
                'id' => 1,
                'role_id' => 1,
                'firstname' => 'N Zaman',
                'lastname' => 'Redoy',
                'contact' => '01742072430',
                'email' => 'hmnredoy@gmail.com',
                'email_verified_at' => '2019-09-07 12:55:11',
                'password' => '$2y$10$l3gqOT2s9ryYfabUTtSWDOEIcigQPrQWnzDO5uSiQSt4jCOaAKj4y',//swtadmin@2019
                'remember_token' => NULL,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

        DB::table('locations')->insert([
            [
                'id' => 1,
                'title' => 'Dhaka',
                'status' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Photographer',
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

        DB::table('jobs')->insert([
            [
                'id' => 1,
                'location_id' => 1,
                'user_id' => 1,
                'title' => 'Photographer needed',
                'expire' => '2020-02-07 12:55:11',
                'budget' => '5000',
                'description' => 'A good photographer needed',
                'status' => JobStatus::submitted,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

        DB::table('profile')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'gender' => 'male',
                'phone' => '01742072430',
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);*/

        DB::table('skill_tools')->insert([
            [
                'id' => 1,
                'title' => 'Photography',
                'status' => 1,
                'type' => SkillToolTypes::skill,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 2,
                'title' => 'Videography',
                'status' => 1,
                'type' => SkillToolTypes::skill,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
            [
                'id' => 3,
                'title' => 'DSLR',
                'status' => 1,
                'type' => SkillToolTypes::tool,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 4,
                'title' => 'Gimbal',
                'status' => 1,
                'type' => SkillToolTypes::tool,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

//        DB::table('user_skill_tool')->insert([
//            [
//                'user_id' => 1,
//                'skill_tool_id' => 1,
//            ],[
//                'user_id' => 1,
//                'skill_tool_id' => 2,
//            ],[
//                'user_id' => 1,
//                'skill_tool_id' => 3,
//            ],[
//                'user_id' => 1,
//                'skill_tool_id' => 4,
//            ],
//        ]);

    /*    DB::table('portfolio')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 2,
                'user_id' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

        DB::table('experiences')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'institute' => 'Softwindtech',
                'title_or_country' => 'Backend Developer',
                'started_at' => '2019-11-20',
                'ended_at' => '2019-11-20',
                'description' => 'I work here',
                'type' => ExperienceTypes::company,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 2,
                'user_id' => 1,
                'institute' => 'Google',
                'title_or_country' => 'Software Engineer',
                'started_at' => '2019-11-20',
                'ended_at' => '2019-11-20',
                'description' => 'I want to work here',
                'type' => ExperienceTypes::company,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 3,
                'user_id' => 1,
                'institute' => 'AIUB',
                'title_or_country' => 'Bangladesh',
                'started_at' => '2019-11-20',
                'ended_at' => '2019-11-20',
                'description' => null,
                'type' => ExperienceTypes::education,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);*/

        DB::table('membership_plans')->insert([
            [
                'id' => 1,
                'title' => 'Starter Package',
                'amount' => 1500,
                'bids' => 15,
                'skills' => 30,
                'coins' => 20,
                'expire_days' => 30,
                'order_index' => 1,
                'status' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 2,
                'title' => 'Basic Package',
                'amount' => 1700,
                'bids' => 20,
                'skills' => 35,
                'coins' => 25,
                'expire_days' => 30,
                'order_index' => 2,
                'status' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 3,
                'title' => 'Economy Package',
                'amount' => 1900,
                'bids' => 25,
                'skills' => 40,
                'coins' => 30,
                'expire_days' => 30,
                'order_index' => 3,
                'status' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],[
                'id' => 4,
                'title' => 'Premium Package',
                'amount' => 2200,
                'bids' => 30,
                'skills' => 45,
                'coins' => 35,
                'expire_days' => 30,
                'order_index' => 4,
                'status' => 1,
                'created_at' => '2019-09-07 12:55:11',
                'updated_at' => '2019-09-07 12:55:11',
            ],
        ]);

    }
}
