<?php

namespace Tests\Feature\administrator_t\CRUDSystem\Department;

use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Repositories\ModelRepository\DepartamentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test extends TestCase
{
    use DatabaseTransactions;

    /**
     * *Создание нового отделения
     *
     * @return void
     */
    public function testCreate()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $department['dep_name_full'] = "09.02.03 Программиовоние в комьютерных системах";
        $department['qualification'] = "Программист-техник";
        $department['image'] = "http://image";
        $department['info'] = "Лучшая специальность в мире, не считая что это мпт";
        $department['studysperiod'] = "3 год 10 месяцев колонии";

        $response = $this->call('POST', '/api/admin/department_management/save', $department);
        
        $response->assertStatus(200);
    } 

    /**
     * *Редактирование отделения
     *
     * @return void
     */
    public function testEdit() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        $rep = new DepartamentRepository();

        $department = $rep->getDepartamentsForCRUDByID(1);
        $department->dep_name_full = "09.02.03 Программиовоние в комьютерных системах";
        $department->qualification = "Программист-техник";
        $department->image = "http://image";
        $department->info = "Лучшая специальность в мире, не считая что это мпт";
        $department->studysperiod = "3 год 10 месяцев колонии";

        
        $response = $this->call('POST', '/api/admin/department_management/edit', json_decode(json_encode($department),true));     

        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * *Удаление отделения
     * 
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        $rep = new DepartamentRepository();
        $department = $rep->getDepartamentsForCRUDByID(2);
        $response = $this->call('POST', '/api/admin/department_management/delete/'.$department->id);        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * *Удаление данных таблицы
     * 
     * @return void
     */
    public function testDrop()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $response = $this->call('POST', '/api/admin/department_management/deleteAll');        
        $response->assertStatus(200); //Проверка на ответ
    }
}
