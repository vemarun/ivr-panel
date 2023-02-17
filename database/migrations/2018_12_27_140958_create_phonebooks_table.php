<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('caller_number',15)->nullable();
            $table->string('caller_name',100)->nullable();
            $table->string('caller_email',100)->nullable();
            $table->string('caller_address',255)->nullable();
            $table->boolean('blacklisted')->default(0);
            $table->boolean('call_reminder')->default(0);
            $table->dateTime('call_reminder_time')->nullable();
            $table->string('remarks',255)->nullable();
            $table->string('priority',20)->nullable();
            $table->timestamps();
            $table->unique(array('user_id','caller_number'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phonebooks');
    }
}
