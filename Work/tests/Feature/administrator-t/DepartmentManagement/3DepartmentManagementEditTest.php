<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartmentManagementEditTest extends TestCase
{
    use DatabaseTransactions;
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

        $department['id'] = Department::orderBy('id', 'desc')->first()->id;
        $department['dep_name'] = "10.02.05";
        $department['specialization'] = "Специализация";
        $department['dep_name_full'] = "10.02.05 Обеспечение информационной безопасности в автоматизированных системах";

        $response = $this->call('POST', '/api/admin/department_management/edit/'.$department['id'], array(
            'department' =>  $department,
        ));

        $response->assertStatus(200);
    }
}