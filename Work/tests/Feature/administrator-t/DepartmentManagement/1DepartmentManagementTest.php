<?php

namespace Tests\Feature;
use App\Models\User;
use Tests\TestCase;

class DepartmentManagementTest extends TestCase
{
    /**
     * A basic test example.
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/admin/department_management');
        $response->assertStatus(200);
    }
}