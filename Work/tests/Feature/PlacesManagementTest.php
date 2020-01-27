<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response = $this->get('/admin/place_managment');
        $response->assertStatus(200);
    }

    /**
     * A add test example.
     * @return void
     */
    public function testAdd()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $place['id'] = -1;
        $place['name'] = "Жопа мира";
        $response = $this->post('/api/admin/place_managment/save/', [$place]);
        $response->assertStatus(500);
    }

    /**
     * A delete test example.
     * @return void
     */
    public function testDelete()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $id = 3;
        $response = $this->post('/api/admin/place_managment/delete/'.$id);
        $response->assertStatus(500);
    }

    /**
     * A edit test example.
     * @return void
     */
    public function testEdit()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $place['id'] = 3;
        $place['name'] = "Жопа мира2";
        $response = $this->post('/api/admin/place_managment/edit/'.$place['id'], [$place]);
        $response->assertStatus(500);
    }
}