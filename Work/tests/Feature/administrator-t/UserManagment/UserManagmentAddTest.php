<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UserManagmentAddTest extends TestCase
{
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
}