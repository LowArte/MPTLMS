<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UserManagementTest extends TestCase
{
    /**
     * A basic test example.
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/admin/user_managment');
        $response->assertStatus(200);
    }

    /**
     * A add test example.
     * @return void
     */
    public function testAdd()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        
        $user['id'] = -1;
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "admin3@mpt.ru";
        $user['password'] = "";
        $user['post_id'] = 4;
        $user['disabled'] = 0;
        
        $response = $this->call('POST', '/api/admin/user_managment/save/', array(
            'user' =>  $user,
        ));
        $response->assertStatus(200);
    }
    /**
     * A delete test example.
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $id = 5;
        $response = $this->post('/api/admin/user_managment/delete/'.$id);
        $response->assertStatus(500);
    }

    /**
     * A edit test example.
     * @return void
     */
    public function testEdit()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        
        $user['id'] = 7;
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "admin3@mpt.ru";
        $user['password'] = "";
        $user['post_id'] = 4;
        $user['disabled'] = 0;
        
        $response = $this->call('POST', '/api/admin/user_managment/edit/'.$user['id'], array(
            'user' =>  $user,
        ));
        $response->assertStatus(200);
    }
}