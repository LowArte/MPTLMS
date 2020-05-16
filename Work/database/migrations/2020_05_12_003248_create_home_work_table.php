<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->json('info');
            $table->smallInteger('type');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /*
        поле info 
        Обязательно title и text date[tema, text] date_end


        поле type
        0 - Просто новость
        1 - домашнее задание
        2 - повременное домашнее задание // info создавать из дат
        3 - Курсовой проект
        4 - Дипломная работы
        5 - Экзамен
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_work');
    }
}
