<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\UsersPost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostManagementEditTest extends TestCase
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

        $post['id'] = UsersPost::orderBy('id', 'desc')->first()->id;
        $post['name'] = "Бомж";

        $response = $this->call('POST', '/api/admin/post_management/edit/'.$post['id'], array(
            'post' =>  $post,
        ));

        $response->assertStatus(200);
    }
}