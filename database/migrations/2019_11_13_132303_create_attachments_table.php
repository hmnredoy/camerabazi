<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {//Polymorphic
            $table->bigIncrements('id');
            $table->string('url');
            $table->string('file_size');
            $table->unsignedBigInteger('attachmentable_id');
            $table->string('attachmentable_type');
            $table->tinyInteger('status')->default(1);
            /*$table->foreign('model_id')
                ->references('id')
                ->on('bids')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
