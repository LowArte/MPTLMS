<?php

namespace Tests\Feature\Student;

use Tests\TestCase;
use App\Models\User;

class JournalTest extends TestCase
{
    public function testTimetable()
    {
        $user = User::Find(2);
        $response = $this->actingAs($user);

        $response = $this->get('/student/journal/');
        $response->assertStatus(200);
    }
}