<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
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
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $place['id'] = -1;
        $place['name'] = "Жопа мира";

        $response = $this->call('POST', '/api/admin/place_managment/save/', array(
            'place' =>  $place,
        ));
        
        $response->assertStatus(500);
    }

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
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $place['id'] = 3;
        $place['name'] = "Жопа мира2";

        $response = $this->call('POST', '/api/admin/place_managment/edit/'.$place['id'], array(
            'place' =>  $place,
        ));

        $response->assertStatus(500);
    }
}