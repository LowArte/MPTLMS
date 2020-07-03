<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagementDeleteTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A delete test example. Должно удаляться также данные о студенте и о преподавателе
     * @return void
     */
    public function testDelete()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $id = User::orderBy('id', 'desc')->first()->id;
        $response = $this->post('/api/admin/user_management/delete/'.$id);
        $response->assertStatus(200);
    }
}