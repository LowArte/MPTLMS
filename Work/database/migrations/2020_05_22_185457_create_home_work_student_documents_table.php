<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWorkStudentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_work_student_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('home_work_student_id');
            $table->text('path');
            $table->text('name');
            $table->foreign('home_work_student_id')->references('id')->on('home_work_students');
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
        Schema::dropIfExists('home_work_student_documents');
    }
}
