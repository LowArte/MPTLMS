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
                $table->string('group_name')->unique();
                $table->string('curs');
                $table->unsignedBigInteger('department_id');
                $table->unsignedBigInteger('child_id')->nullable()->default(null);
                $table->foreign('department_id')->references('id')->on('departments');
                $table->foreign('child_id')->references('id')->on('groups');
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
