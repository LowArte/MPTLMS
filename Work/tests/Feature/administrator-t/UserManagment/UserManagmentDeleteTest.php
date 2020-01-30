<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UserManagmentDeleteTest extends TestCase
{
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
}