<?php

namespace Tests\Feature\administrator_t\CRUDSystem\Users;

use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Repositories\ModelRepository\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test extends TestCase
{
    use DatabaseTransactions;
    //!----------------------------------------------------
    //!         Создание        !//
    //!----------------------------------------------------
    /**
     * Создание нового пользователя 
     * Администратор
     * @return void
     */
    public function testCreate()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $user['secName'] = "Бог";
        $user['name'] = "и";
        $user['thirdName'] = "Царь";
        $user['email'] = "Мыло@mail.ru";
        $user['disabled'] = 0;
        $user['post_id'] = 1;

        $response = $this->call('POST', '/api/admin/user_management/save', $user);
        $response->assertStatus(200);
    } 

    /**
     * Создание нового пользователя 
     * Студент
     * @return void
     */
    public function testCreateStudent()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $user['secName'] = "Бог";
        $user['name'] = "и";
        $user['thirdName'] = "Царь";
        $user['email'] = "Мыло@mail.ru";
        $user['disabled'] = 0;
        $user['post_id'] = 2;

        $student['group_id'] = 1;
        $student['birthday'] = "01.01.2000";
        $student['gender'] = 0;
        $student['type_of_financing'] = "Бюджетный";

        $user['dop'] = $student; 

        $response = $this->call('POST', '/api/admin/user_management/save', $user);
        $response->assertStatus(200);
    } 

    /**
     * Создание нового пользователя 
     * Преподаватель
     * Отличие от студента только в том, что в таблице преподов id фиксируется
     * @return void
     */
    public function testCreateTeacher()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $user['secName'] = "Бог";
        $user['name'] = "и";
        $user['thirdName'] = "Царь";
        $user['email'] = "Мыло@mail.ru";
        $user['disabled'] = 0;
        $user['post_id'] = 3;

        $response = $this->call('POST', '/api/admin/user_management/save', $user);
        $response->assertStatus(200);
    } 



    //!----------------------------------------------------
    //!         Редактирование        !//
    //!----------------------------------------------------
    /**
     * Редактирование пользователя
     * Администратор
     * @return void
     */
    public function testEdit() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(1);
        $user->secName = "Бог";
        $user->name = "и";
        $user->thirdName = "Царь";
        $user->email = "Мыло@mail.ru";
        $user->disabled = 0;
        $user->post_id = 1;

        $response = $this->call('POST', '/api/admin/user_management/edit', json_decode(json_encode($user),true));        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Редактирование пользователя
     * Студент
     * @return void
     */
    public function testEditStudent() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(2);
        $user->secName = "Бог";
        $user->name = "и";
        $user->thirdName = "Царь";
        $user->email = "Мыло@mail.ru";
        $user->disabled = 0;
        $user->post_id = 2;

        $student['group_id'] = 1;
        $student['birthday'] = "01.01.2000";
        $student['gender'] = 0;
        $student['type_of_financing'] = "Бюджетный";

        $user->dop = $student; 

        $response = $this->call('POST', '/api/admin/user_management/edit', $user);        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Редактирование пользователя
     * Студент на админа
     * @return void
     */
    public function testEditStudentToAdmin() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(2);
        $user->secName = "Бог";
        $user->name = "и";
        $user->thirdName = "Царь";
        $user->email = "Мыло@mail.ru";
        $user->disabled = 0;
        $user->post_id = 1;

        $response = $this->call('POST', '/api/admin/user_management/edit', json_decode(json_encode($user),true));        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Редактирование пользователя
     * Преподаватель
     * Берём за основу учебную часть
     * @return void
     */
    public function testEditAdminToStudent() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(1);
        $user->secName = "Бог";
        $user->name = "и";
        $user->thirdName = "Царь";
        $user->email = "Мыло@mail.ru";
        $user->disabled = 0;
        $user->post_id = 2;

        $student['group_id'] = 1;
        $student['birthday'] = "01.01.2000";
        $student['gender'] = 0;
        $student['type_of_financing'] = "Бюджетный";

        $user->dop = $student;
        
        $response = $this->call('POST', '/api/admin/user_management/edit', json_decode(json_encode($user),true));        
        $response->assertStatus(200); //Проверка на ответ
    }






    //!----------------------------------------------------
    //!         Удаление        !//
    //!----------------------------------------------------
    /**
     * Удаление пользователя
     * Администратор
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(1);
        
        $response = $this->call('POST', '/api/admin/user_management/delete/'.$user->id);        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Удаление пользователя
     * Студент
     * @return void
     */
    public function testDeleteStudent()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(2);
        
        $response = $this->call('POST', '/api/admin/user_management/delete/'.$user->id);        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Удаление пользователя
     * Преподователь
     * @return void
     */
    public function testDeleteStudent()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UserRepository();
        $user = $rep->getUserForCRUDByID(3);
        
        $response = $this->call('POST', '/api/admin/user_management/delete/'.$user->id);        
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

        $response = $this->call('POST', '/api/admin/user_management/deleteAll');        
        $response->assertStatus(200); //Проверка на ответ
    }
}