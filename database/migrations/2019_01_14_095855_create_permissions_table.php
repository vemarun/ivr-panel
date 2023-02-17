<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->boolean('can_add_source_number', 10)->default(1);
            $table->boolean('can_change_dialing_strategy', 10)->default(1);
            $table->boolean('can_see_call_answer_time')->default(0);
            $table->boolean('can_see_conv_duration')->default(0);
            $table->boolean('can_see_caller_circle')->default(1);
            $table->boolean('can_see_caller_operator')->default(1);
            $table->boolean('can_see_caller_mobile')->default(1);
            $table->boolean('can_receive_call_report_email')->default(0);
            $table->boolean('can_listen_recording')->default(1);
            $table->boolean('send_recording_text_to_url')->default(0);
            $table->boolean('recording_keyword_mapping')->default(0);
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
        Schema::dropIfExists('permissions');
    }
}
