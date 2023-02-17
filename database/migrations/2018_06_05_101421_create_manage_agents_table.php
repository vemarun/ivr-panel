<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_agents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('source_number', 15)->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('ext')->nullable();
            $table->string('agent_name', 50)->nullable();
            $table->string('agent_destination', 15)->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('call_status')->default(0);
            $table->string('assigned_to_caller', 15)->nullable();
            $table->integer('total_inbound_calls')->default(0);
            $table->integer('today_inbound_calls')->default(0);
            $table->integer('total_outbound_calls')->default(0);
            $table->integer('today_outbound_calls')->default(0);
            $table->string('remarks', 255)->nullable();
            $table->float('agent_rating')->default(5);
            $table->timestamps();
            $table->unique(array('source_number', 'agent_destination'));
            $table->unique(array('source_number', 'agent_name'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_agents');
    }
}
