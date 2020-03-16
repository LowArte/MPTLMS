<?php

namespace Tests\Feature\administrator-t\CRUDSystem\Places;

use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Repositories\ModelRepository\PlaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test extends TestCase
{
    use DatabaseTransactions;

    /**
     * Создание нового места проведения
     *
     * @return void
     */
    public function testCreate()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $place['place_name'] = "Санкт-Петербург";

        $response = $this->call('POST', '/api/admin/place_management/save', $place);
        $response->assertStatus(200);
    } 

    /**
     * Редактирование места проведения
     *
     * @return void
     */
    public function testEdit() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new PlaceRepository();
        $place = $rep->getPlaceForCRUDByID(1);
        $place['place_name'] = "Санкт-Петербург";

        $response = $this->call('POST', '/api/admin/place_management/edit', json_decode(json_encode($place),true));        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Удаление места проведения
     * 
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        $rep = new PlaceRepository();
        $place = $rep->getGroupForCRUDByID(2);
        $response = $this->call('POST', '/api/admin/place_management/delete/'.$place->id);        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Удаление данных таблицы
     * 
     * @return void
     */
    public function testDrop()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $response = $this->call('POST', '/api/admin/place_management/deleteAll');        
        $response->assertStatus(200); //Проверка на ответ
    }
}