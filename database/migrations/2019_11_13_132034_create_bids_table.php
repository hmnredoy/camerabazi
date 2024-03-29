<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('freelancer_id');
            $table->string('job_freelancer');
            $table->double('amount');
            $table->string('delivery_days');
            $table->text('description');
            $table->tinyInteger('status')->default(\App\Models\Enums\BidStatus::Offered);
            $table->timestamps();

            $table->unique(['job_id','freelancer_id', 'job_freelancer']);

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('bids');
        Schema::enableForeignKeyConstraints();
        Schema::drop('bids');
        Schema::disableForeignKeyConstraints();
    }
}
