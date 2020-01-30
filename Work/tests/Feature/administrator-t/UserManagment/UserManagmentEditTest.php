<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UserManagmentEditTest extends TestCase
{
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