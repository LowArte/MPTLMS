<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;

class PlacesManagmentEditTest extends TestCase
{
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