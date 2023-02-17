<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series');
            $table->string('operator',50)->nullable();
            $table->string('circle',50)->nullable();
            $table->string('remarks',50)->nullable();
            $table->timestamps();
            $table->unique(array('series','operator','circle'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_series');
    }
}
