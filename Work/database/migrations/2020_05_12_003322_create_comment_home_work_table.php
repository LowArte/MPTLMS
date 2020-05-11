<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentHomeWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_home_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('type');
            $table->unsignedBigInteger('to_user_id');
            $table->foreign('to_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('comment_home_work');
    }
}
