<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlacesManagmentAddTest extends TestCase
{
    use DatabaseTransactions;
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
        
        $response->assertStatus(200);
    }
}