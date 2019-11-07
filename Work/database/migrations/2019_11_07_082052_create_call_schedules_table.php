<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('call_schedule');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')->references('id')->on('places');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_schedules');
    }
}
