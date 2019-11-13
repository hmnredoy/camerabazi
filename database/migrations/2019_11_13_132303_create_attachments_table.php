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
            $table->integer('attachmentable_id');
            $table->string('attachmentable_type');
            /*$table->foreign('model_id')
                ->references('bids')
                ->on('id')
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
