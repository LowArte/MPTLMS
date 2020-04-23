<?php

namespace Tests\Feature;

use App\Models\Department;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetrainingManagementDeleteTest extends TestCase
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

        $id = Department::orderBy('id', 'desc')->first()->id;
        $response = $this->post('/api/admin/retraining_management/delete/'.$id);
        $response->assertStatus(200);
    }
}