<?php

namespace Tests\Feature;

use App\Models\Departament;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartamentManagementDeleteTest extends TestCase
{
    use DatabaseTransactions;
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

        $id = Departament::orderBy('id', 'desc')->first()->id;
        $response = $this->post('/api/admin/department_management/delete/'.$id);
        $response->assertStatus(200);
    }
}