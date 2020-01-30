<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;

class UserManagmentTest extends TestCase
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
}