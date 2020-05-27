<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWorkStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_work_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('association_home_work_id');
            $table->unsignedBigInteger('student_id');
            $table->json('info');
            $table->foreign('association_home_work_id')->references('id')->on('association_home_work');
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::dropIfExists('home_work_students');
    }
}
