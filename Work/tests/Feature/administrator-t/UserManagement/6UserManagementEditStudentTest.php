<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagementEditStudentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A edit test example.
     * @return void
     */
    public function testEditStudent()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );
        
        $user['id'] = User::Find(2)->id; //Студент должны удалиться. Данные об студенте при смене должности
        $user['secName'] = "Борисов";
        $user['name'] = "Артём";
        $user['thirdName'] = "Игоревич";
        $user['email'] = "student1@mpt.ru";
        $user['password'] = "";
        $user['post_id'] = 3;
        $user['disabled'] = 1;
        
        $response = $this->call('POST', '/api/admin/user_management/edit/'.$user['id'], array(
            'user' =>  $user,
        ));

        $response->assertStatus(200);
    }
}