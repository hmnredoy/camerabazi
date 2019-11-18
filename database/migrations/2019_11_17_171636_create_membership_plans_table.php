<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->double('amount')->default(0);
            $table->integer('bids')->default(0);
            $table->integer('skills')->default(0);
            $table->integer('coins')->default(0);
            $table->integer('expire_days')->nullable();
            $table->integer('order_index')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_plans');
    }
}
