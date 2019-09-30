<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login_email')->unique();
            $table->string('login_stud')->unique();
            $table->string('password');
            $table->string('password_notHash');
            $table->string('name');
            $table->string('secName');
            $table->string('thirdName');
            $table->string('api_token')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('users_posts');
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
        Schema::dropIfExists('users');
    }
}
