<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('source_number',15)->nullable();
            $table->string('path',200)->nullable();
            $table->string('original_filename',100)->nullable();
            $table->integer('file_size')->nullable();
            $table->string('sequence',30)->nullable();
            $table->boolean('status')->default(1);
            $table->string('recording_type',50)->nullable();
            $table->integer('template_id')->nullable();
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('recordings');
    }
}
