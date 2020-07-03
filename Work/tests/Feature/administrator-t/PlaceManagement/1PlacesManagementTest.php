<?php

namespace Tests\Feature;
use App\Models\User;
use Tests\TestCase;

class PlacesManagementTest extends TestCase
{
    /**
     * A basic test example.
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/admin/place_management');
        $response->assertStatus(200);
    }
}