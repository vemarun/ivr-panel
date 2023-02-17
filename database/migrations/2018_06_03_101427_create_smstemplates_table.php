<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmstemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smstemplates', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
            $table->string('source_number',15)->unique();
            
            $table->boolean('sms_to_owner_enabled')->default(1);
			$table->string('sms_to_owner',160)->default('You have received a call from #CALLER# at #TIME# attended by #AGENTNAME# On #AGENTNUMBER#');
            
            $table->boolean('sms_to_owner_missed_enabled')->default(1);
			$table->string('sms_to_owner_missed',160)->default('Call Missed from #CALLER# (#OPERATOR#) Circle #CIRCLE# at #TIME#. #AGENTNAME#');
            
            $table->boolean('sms_to_caller_enabled')->default(1);
			$table->string('sms_to_caller',160)->default('We recognize your call , We will contact you shortly.');
            
            $table->boolean('sms_to_caller_missed_enabled')->default(1);
			$table->string('sms_to_caller_missed',160)->default('We recognize your call , our executive will call you shortly.');
            
            $table->boolean('sms_to_agent_enabled')->default(1);
			$table->string('sms_to_agent',160)->default('You have talked with contact no #CALLER# At #TIME#');
            
			$table->string('sms_sender_id',20)->default('imyIVR');
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
        Schema::dropIfExists('smstemplates');
    }
}
