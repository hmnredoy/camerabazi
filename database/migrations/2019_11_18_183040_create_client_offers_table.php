<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('bid_id');
            $table->string('client_freelancer_bid');
            $table->double('amount');
            $table->string('delivery_days');
            $table->text('message')->nullable();

            $table->unique(['client_freelancer_bid']);

            $table->foreign('freelancer_id')->on('users')->references('id');
            $table->foreign('client_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('bid_id')->on('bids')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('client_offers');
    }
}
