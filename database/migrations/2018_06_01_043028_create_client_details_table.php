<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_details', function (Blueprint $table) {
               $table->increments('id');	//client -> user_id
               $table->integer('user_id')->unique();
            
            $table->string('industry_type',50)->nullable();
            $table->string('product_type',50)->nullable();
            $table->string('price_slab',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('locality',100)->nullable();
            
            //for personal detail form
            
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('contact',15)->nullable();
            $table->string('stdcode',5)->nullable();
            $table->string('landline',15)->nullable();
            $table->string('companyname',100)->nullable();
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
        Schema::dropIfExists('client_details');
    }
}
