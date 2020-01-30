<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;

class PlacesManagmentDeleteTest extends TestCase
{
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
}