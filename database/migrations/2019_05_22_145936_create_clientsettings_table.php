<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('source_number',15)->nullable();
            $table->string('crm_url',150)->nullable();
            $table->string('crm_url_method',5)->default('POST');
            $table->string('recording_text_url')->nullable();
            $table->string('recoring_text_url_method')->default('POST');
            $table->text('recording_keywords')->nullable();
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
        Schema::dropIfExists('clientsettings');
    }
}
