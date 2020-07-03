<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagementAddStudentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A addStudent test example.
     * @return void
     */
    public function testAddStudent()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        
        $user['id'] = -1;
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "admin1@mpt.ru";
        $user['password'] = "";
        $user['post_id'] = 4;
        $user['disabled'] = 0;

        $student['id'] = -1;
        $student['group_id'] = 2;
        $student['birthday'] = "01.01.2000";
        $student['gender'] = "Мужской";
        $student['type_of_financing'] = "Бюджетный";
        
        $response = $this->call('POST', '/api/admin/user_management/save/', array(
            'user' =>  $user,
            'student' => $student
        ));
        $response->assertStatus(200);
    }
}