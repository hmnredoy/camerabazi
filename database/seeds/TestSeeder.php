<?php

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
       // DB::table('jobs')->delete();
//        DB::table('locations')->delete();
//        DB::table('categories')->delete();
//        DB::table('users')->delete();

//        DB::table('users')->insert([
//            [
//                'id' => 1,
//                'role_id' => 1,
//                'firstname' => 'N Zaman',
//                'lastname' => 'Redoy',
//                'contact' => '01742072430',
//                'email' => 'hmnredoy@gmail.com',
//                'email_verified_at' => '2019-09-07 12:55:11',
//                'password' => '$2y$10$l3gqOT2s9ryYfabUTtSWDOEIcigQPrQWnzDO5uSiQSt4jCOaAKj4y',//swtadmin@2019
//                'remember_token' => NULL,
//                'created_at' => '2019-09-07 12:55:11',
//                'updated_at' => '2019-09-07 12:55:11',
//            ],
//        ]);

//        DB::table('locations')->insert([
//            [
//                'id' => 1,
//                'location' => 'Dhaka',
//                'created_at' => '2019-09-07 12:55:11',
//                'updated_at' => '2019-09-07 12:55:11',
//            ],
//        ]);

//        DB::table('categories')->insert([
//            [
//                'id' => 1,
//                'name' => 'Photographer',
//                'created_at' => '2019-09-07 12:55:11',
//                'updated_at' => '2019-09-07 12:55:11',
//            ],
//        ]);

//        DB::table('jobs')->insert([
//            [
//                'id' => 1,
//                'location_id' => 1,
//                'category_id' => 1,
//                'user_id' => 1,
//                'title' => 'Photographer needed',
//                'expire' => '2020-02-07 12:55:11',
//                'budget' => '5000',
//                'description' => 'A good photographer needed',
//                'created_at' => '2019-09-07 12:55:11',
//                'updated_at' => '2019-09-07 12:55:11',
//            ],
//        ]);


    }
}
