<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientManageSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_manage_sources', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->string('source_number',15)->unique();
			$table->string('title',20)->nullable();
			$table->boolean('enabled')->default(1);
            $table->string('dialing_strategy',25)->nullable();
            $table->integer('ring_time_out')->nullable();
            $table->integer('call_time_out')->nullable();
            $table->string('service_type',20)->default('agent');
            $table->string('remarks',255)->nullable();
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
        Schema::dropIfExists('client_manage_sources');
    }
}
