<?php

namespace Tests\Feature\administrator_t\CRUDSystem\Posts;

use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Repositories\ModelRepository\UsersPostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test extends TestCase
{
    use DatabaseTransactions;

    /**
     * Создание новой роли
     *
     * @return void
     */
    public function testCreate()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $post['name'] = "Бог и царь";
        $post['slug'] = "god";

        $response = $this->call('POST', '/api/admin/post_management/save', $post);
        $response->assertStatus(200);
    } 

    /**
     * Редактирование роли
     *
     * @return void
     */
    public function testEdit() 
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UsersPostRepository();
        $post = $rep->getPostForCRUDByID(1);
        $post['name'] = "Бог и царь";
        $post['slug'] = "god";

        $response = $this->call('POST', '/api/admin/post_management/edit', json_decode(json_encode($post),true));        
        $response->assertStatus(200); //Проверка на ответ
    }

    /**
     * Удаление роли
     * 
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $rep = new UsersPostRepository();
        $post = $rep->getPostForCRUDByID(2);
        
        $response = $this->call('POST', '/api/admin/post_management/delete/'.$post->id);        
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

        $response = $this->call('POST', '/api/admin/post_management/deleteAll');        
        $response->assertStatus(200); //Проверка на ответ
    }
}