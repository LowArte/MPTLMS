<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Group;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupManagementEditTest extends TestCase
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

        $group['id'] = Group::orderBy('id', 'desc')->first()->id;
        $group['group_name'] = "П-2-15";
        $group['study_period'] = "3 года 10 месяцев";
        $group['arr_type_of_study'] = "Очная";
        $group['сurs'] = 2;
        $group['departments_id'] = 2;

        $response = $this->call('POST', '/api/admin/group_management/edit/'.$group['id'], array(
            'group' =>  $group,
        ));

        $response->assertStatus(200);
    }
}