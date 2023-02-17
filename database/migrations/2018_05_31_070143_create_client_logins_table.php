<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_logins', function (Blueprint $table) {
            
            //Client Login Details
            
            $table->increments('id');
            $table->string('username',30)->unique();
            $table->string('password',100);
            $table->integer('created_by')->nullable();
            $table->boolean('is_active')->default('1');   /*modifier to ban/stop access any user from website*/
            $table->string('client_type',10);

            $table->integer('validity')->nullable();
            
            $table->integer('plan')->nullable();
            $table->string('ivr_plan',50)->nullable();
            $table->integer('ivr_credit')->nullable();
            $table->integer('sms_credit')->nullable();
            $table->string('credit_deduction_basis',15)->nullable();

			$table->char('api_token', 60)->unique()->nullable();
			
			$table->rememberToken();
			$table->timestamps();
            $table->string('ip_address', 15)->nullable();
            $table->string('user_agent',200)->nullable();
            $table->integer('otp')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_logins');
    }
}
