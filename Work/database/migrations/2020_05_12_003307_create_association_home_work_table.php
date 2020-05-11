<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationHomeWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_home_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('homework_id');
            $table->unsignedBigInteger('journal_id');
            $table->foreign('homework_id')->references('id')->on('home_work');
            $table->foreign('journal_id')->references('id')->on('journals');
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
        Schema::dropIfExists('association_home_work');
    }
}
