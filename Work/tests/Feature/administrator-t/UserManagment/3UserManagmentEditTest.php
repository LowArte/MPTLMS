<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagmentEditTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A edit test example.
     * @return void
     */
    public function testEdit1() //Заметки к тесту если редактировать пользователя и не изменять почту, выкинет ошибку, что такая почта используется
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        
        $user['id'] = User::orderBy('id', 'desc')->first()->id;
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "admin1@mpt.ru";
        $user['password'] = "";
        $user['post_id'] = 4;
        $user['disabled'] = 1;
        
        $response = $this->call('POST', '/api/admin/user_managment/edit/'.$user['id'], array(
            'user' =>  $user,
        ));
        $response->assertStatus(200);
    }
    /**
     * A edit test example.
     * @return void
     */
    public function testEdit2() //Заметки к тесту если редактировать пользователя и не изменять почту, выкинет ошибку, что такая почта используется
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        
        $user['id'] = User::orderBy('id', 'desc')->first()->id;
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "admin2@mpt.ru";
        $user['password'] = "";
        $user['post_id'] = 4;
        $user['disabled'] = 1;
        
        $response = $this->call('POST', '/api/admin/user_managment/edit/'.$user['id'], array(
            'user' =>  $user,
        ));
        $response->assertStatus(200);
    }
}