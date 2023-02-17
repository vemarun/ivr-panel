<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('source_number',15)->nullable();
            $table->string('group_name', 50)->nullable();
            $table->string('holidays', 50);
            $table->time('office_start_time')->default('09:00');
            $table->time('office_end_time')->default('06:00');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->unique(array('user_id', 'group_name'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
