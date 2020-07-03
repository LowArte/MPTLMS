<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostManagementAddTest extends TestCase
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

        $post['id'] = -1;
        $post['name'] = "Бомж";

        $response = $this->call('POST', '/api/admin/post_management/save/', array(
            'post' =>  $post,
        ));
        
        $response->assertStatus(200);
    }
}