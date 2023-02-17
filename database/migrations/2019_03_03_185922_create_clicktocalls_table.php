<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicktocallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicktocalls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('source_number', 15)->nullable();
            $table->string('caller_number', 15)->nullable();
            $table->string('agent_number', 15)->nullable();
            $table->boolean('call_status')->default(0);
            $table->integer('call_time_out')->default(0);
            $table->integer('ring_time_out')->default(30);
            $table->string('dialing_strategy', 30)->default('sequence');
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
        Schema::dropIfExists('clicktocalls');
    }
}
