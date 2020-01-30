<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class ReplacementTest extends TestCase
{
    public function testReplacement()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/admin/replacements/');
        $response->assertStatus(200);
    }
}