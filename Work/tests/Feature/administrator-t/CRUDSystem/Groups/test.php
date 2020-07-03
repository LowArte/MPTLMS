<?php

namespace Tests\Feature\administrator_t\CRUDSystem\Groups;

use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Repositories\ModelRepository\GroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test extends TestCase
{
    use DatabaseTransactions;

    /**
     * Создание новой группы
     *
     * @return void
     */
    public function testCreate()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $group['group_name'] = "БИ50";
        $group['group_number'] = 1;
        $group['group_year'] = 16;
        $group['сurs'] = 4;
        $group['departments_id'] = 1;

        $response = $this->call('POST', '/api/admin/group_management/save', $group);
        $response->assertStatus(200);
    } 

    /**
     * Редактирование группы
     *
     * @return void
     */
    public function testEdit() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new GroupRepository();
        $group = $rep->getGroupForCRUDByID(1);
        $group->group_name = "БИ50";
        $group->group_number = 1;
        $group->group_year = 16;
        $group->сurs = 4;
        $group->departments_id = 1;

        $response = $this->call('POST', '/api/admin/group_management/edit', json_decode(json_encode($group),true));        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Удаление группы
     * 
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        $rep = new GroupRepository();
        $group = $rep->getGroupForCRUDByID(2);
        $response = $this->call('POST', '/api/admin/group_management/delete/'.$group->id);        
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

        $response = $this->call('POST', '/api/admin/group_management/deleteAll');        
        $response->assertStatus(200); //Проверка на ответ
    }
}