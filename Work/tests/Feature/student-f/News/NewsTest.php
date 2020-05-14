<?php

namespace Tests\Feature\Student;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsTest extends TestCase
{
    use DatabaseTransactions;
    public function testNews()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);
        $response = $this->get('/student/certificate');
        $response->assertStatus(200);
    }

    public function testLikeNews()
    {
        Passport::actingAs(
            User::Find(2),
            ['create-servers']
        );

        $data = array("new_id" => 1, "user_id" => 2);
        $response = $this->call('POST', '/api/functions/set_like', $data);
        $response->assertStatus(200);
    }

    public function testLike1News()
    {
        Passport::actingAs(
            User::Find(2),
            ['create-servers']
        );

        $data = array("new_id" => 1, "user_id" => 2);
        $response = $this->call('POST', '/api/functions/set_like', $data);
        $response->assertStatus(200);
    }

    public function testLike500News()
    {
        Passport::actingAs(
            User::Find(2),
            ['create-servers']
        );

        $data = array("new_id" => 100, "user_id" => 2);
        $response = $this->call('POST', '/api/functions/set_like', $data);
        $response->assertStatus(500);
    }
}