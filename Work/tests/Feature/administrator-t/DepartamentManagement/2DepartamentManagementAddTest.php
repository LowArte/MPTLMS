<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartamentManagementAddTest extends TestCase
{
    use DatabaseTransactions;
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

        $department['id'] = -1;
        $department['dep_name'] = "10.02.05";
        $department['specialization'] = "Специализация";
        $department['dep_name_full'] = "10.02.05 Обеспечение информационной безопасности в автоматизированных системах";

        $response = $this->call('POST', '/api/admin/department_management/save/', array(
            'department' =>  $department,
        ));
        
        $response->assertStatus(200);
    }
}