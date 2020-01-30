<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class Home extends TestCase
{
    public function HomeTest()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/admin/home/');
        $response->assertStatus(200);
    }
}