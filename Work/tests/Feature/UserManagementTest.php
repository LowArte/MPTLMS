<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

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
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $user['id'] = -1;
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "admin@mpt.ru";
        $user['password'] = "Борисов";
        $user['post_id'] = "Борисов";
        $user['disabled'] = "Борисов";

        $response = $this->post('/api/admin/user_managment/save/', [$user]);
        $response->assertStatus(200);
    }

    /**
     * A delete test example.
     * @return void
     */
    public function testDelete()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $id = 5;
        $response = $this->post('/api/admin/user_managment/delete/'.$id);
        $response->assertStatus(200);
    }
}