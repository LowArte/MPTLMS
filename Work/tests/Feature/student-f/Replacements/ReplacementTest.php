<?php

namespace Tests\Feature\Student;

use Tests\TestCase;
use App\Models\User;

class ReplacementTest extends TestCase
{
    public function testReplacement()
    {
        $user = User::Find(2);
        $response = $this->actingAs($user);

        $response = $this->get('/student/replacements/');
        $response->assertStatus(200);
    }
}