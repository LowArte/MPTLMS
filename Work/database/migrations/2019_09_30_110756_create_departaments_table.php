<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'departaments',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('dep_name');
                $table->string('dep_name_full');
                $table->string('qualification');
                $table->string('about');
                $table->string('image');
                $table->string('studysperiod');
                $table->json('info');
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
        Schema::dropIfExists('departaments');
    }
}
