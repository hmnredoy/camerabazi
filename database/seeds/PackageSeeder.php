<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $starter = new \App\Models\Package();
        $starter->title = 'Starter Package';
        $starter->bid_per_month = 15;
        $starter->coin_per_month=20;
        $starter->save();

        $basic = new \App\Models\Package();
        $basic->title = 'Basic Package';
        $basic->bid_per_month = 20;
        $basic->coin_per_month=30;
        $basic->save();

    }
}
