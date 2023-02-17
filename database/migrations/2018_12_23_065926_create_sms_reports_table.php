<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('source_number',15)->nullable();
            $table->string('senderid',15)->nullable();
            $table->string('mobile',15);
            $table->string('circle',50)->nullable();
            $table->string('operator',50)->nullable();
            $table->text('message');
            $table->dateTime('delivered_time')->nullable();
            $table->string('status',30)->nullable();
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
        Schema::dropIfExists('sms_reports');
    }
}
