<?php

namespace Tests\Feature\Student;

use Tests\TestCase;
use App\Models\User;

class TimetableTest extends TestCase
{
    public function testTimetable()
    {
        $user = User::Find(2);
        $response = $this->actingAs($user);

        $response = $this->get('/student/timetable/');
        $response->assertStatus(200);
    }
}