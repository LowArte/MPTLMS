<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Places;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlacesManagementDeleteTest extends TestCase
{
    use DatabaseTransactions;
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

        $id = Places::orderBy('id', 'desc')->first()->id;
        $response = $this->post('/api/admin/place_management/delete/'.$id);
        $response->assertStatus(200);
    }
}