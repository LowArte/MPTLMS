<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Places;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlacesManagementEditTest extends TestCase
{
    use DatabaseTransactions;
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

        $place['id'] = Places::orderBy('id', 'desc')->first()->id;
        $place['name'] = "мир2";

        $response = $this->call('POST', '/api/admin/place_management/edit/'.$place['id'], array(
            'place' =>  $place,
        ));

        $response->assertStatus(200);
    }
}