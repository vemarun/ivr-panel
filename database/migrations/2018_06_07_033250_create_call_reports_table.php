<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('caller_number', 15)->nullable();
            $table->string('source_number', 15)->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('answer_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('duration')->default(0);
            $table->integer('conv_duration')->default(0);
            $table->string('keypress', 255)->nullable();
            $table->string('conv_recordings', 255)->nullable();
            $table->string('agent_number', 15)->nullable();
            $table->string('priority', 20)->nullable();
            $table->string('add_remark', 100)->nullable();
            $table->boolean('save_caller')->default(0);
            $table->string('call_status', 30)->nullable();
            $table->integer('credit_deducted')->default(0);
            $table->boolean('report_status')->default(0);
            $table->string('circle', 50)->nullable();
            $table->string('operator', 50)->nullable();
            $table->integer('call_rating')->nullable();
            $table->string('call_type', 20)->default('Inbound')->comment = "Inbound or Outbound";
            $table->string('call_id', 64)->nullable()->unique();
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
        Schema::dropIfExists('call_reports');
    }
}
