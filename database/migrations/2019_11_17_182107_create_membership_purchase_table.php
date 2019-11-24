<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('membership_id');
            $table->double('amount')->default(0);
            $table->integer('bids')->default(0);
            $table->integer('skills')->default(0);
            $table->integer('coins')->default(0);
            $table->timestamp('expire')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('membership_id')->references('id')->on('membership_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_purchase');
    }
}
