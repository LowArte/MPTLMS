<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationUsersHomeWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_users_home_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('home_work_id');
            $table->smallInteger('access');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('home_work_id')->references('id')->on('home_work');
            $table->timestamps();
        });
    }

    /*
        поле access 
        0 - только чтение
        1 - только чтение и пользование
        2 - редактирование
        3 - админ задания
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('association_users_home_work');
    }
}
