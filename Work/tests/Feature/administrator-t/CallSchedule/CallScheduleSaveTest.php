<?php

namespace Tests\Feature;
use App\Models\User;
use Tests\TestCase;
use App\Repositories\CallScheduleRepository;
use Laravel\Passport\Passport;

class CallScheduleSaveTest extends TestCase
{
    /**
     * A CallScheduleSave test example.
     * @return void
     */
    public function testCallScheduleSaveTest()
    {
        Passport::actingAs(
            User::Find(1),
            ['create-servers']
        );

        $callScheduleRepository = new CallScheduleRepository();
        $callSchedule = $callScheduleRepository->getCallSchedule();

        $response = $this->call('POST', '/api/admin/callschedule/save_bildcallschedule', [$callSchedule]);
        $response->assertStatus(200);
    }
}