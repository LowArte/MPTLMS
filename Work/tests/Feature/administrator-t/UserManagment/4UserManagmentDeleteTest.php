<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagmentDeleteTest extends TestCase
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

        $id = User::orderBy('id', 'desc')->first()->id;
        $response = $this->post('/api/admin/user_managment/delete/'.$id);
        $response->assertStatus(200);
    }
}