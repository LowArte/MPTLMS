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
            $table->unsignedBigInteger('home_work_id');
            $table->unsignedBigInteger('group_id');
            $table->foreign('home_work_id')->references('id')->on('home_work');
            $table->foreign('group_id')->references('id')->on('groups');
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
        Schema::dropIfExists('association_home_work');
    }
}
