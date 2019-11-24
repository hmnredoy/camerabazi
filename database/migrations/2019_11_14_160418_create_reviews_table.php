<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('posted_by');
            $table->unsignedBigInteger('posted_on');
            $table->unsignedBigInteger('job_id');
            $table->string('commenter_job');
            $table->text('comment')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['posted_by', 'job_id', 'commenter_job']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('posted_on')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('posted_by')
                ->references('id')
                ->on('users');

            $table->foreign('job_id')
                ->references('id')
                ->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::drop('reviews');
        Schema::disableForeignKeyConstraints();
    }
}
