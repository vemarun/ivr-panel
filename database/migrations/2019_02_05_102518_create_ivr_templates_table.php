<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIvrTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivr_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template_name', 30)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('source_number', 15)->nullable();
            $table->integer('no_of_recordings')->default(0);
            $table->integer('no_of_uploaded_recordings')->default(0);
            $table->text('templates')->nullable();
            $table->boolean('status')->default(0);
            $table->string('remarks', 150)->nullable();
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
        Schema::dropIfExists('ivr_templates');
    }
}
