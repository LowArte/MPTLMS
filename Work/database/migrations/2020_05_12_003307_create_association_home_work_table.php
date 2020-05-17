<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationHomeWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_home_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('homework_id');
            $table->unsignedBigInteger('group_id');
            $table->json('home_work_access');
            $table->foreign('homework_id')->references('id')->on('home_work');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /*
    {
        1 {
            text: string
            links: [],
            files: [],
            isChecked: 0

        }
        
            json home_work_access
            0 - Сдано
            1 - Не сдано
            2 - Сдано с опозданием
            3 - Возвращено
            4 - Ожидается
        
    }*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('association_home_work');
    }
}
