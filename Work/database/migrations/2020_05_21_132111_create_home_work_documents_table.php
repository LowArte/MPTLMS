<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWorkDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_work_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('home_work_id');
            $table->text('path');
            $table->text('name');
            $table->foreign('home_work_id')->references('id')->on('home_work');
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
        Schema::dropIfExists('home_work_documents');
    }
}
