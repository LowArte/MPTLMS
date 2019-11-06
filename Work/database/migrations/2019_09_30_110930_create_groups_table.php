<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'groups',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('group_name');
                $table->string('study_period');
                $table->string('type_of_study');
                $table->string('сurs');
                $table->unsignedBigInteger('departaments_id');
                $table->foreign('departaments_id')->references('id')->on('departaments');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
