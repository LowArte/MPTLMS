<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupManagementAddTest extends TestCase
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

        $group['id'] = -1;
        $group['group_name'] = "П-2-15";
        $group['study_period'] = "3 года 10 месяцев";
        $group['arr_type_of_study'] = "Очная";
        $group['сurs'] = 2;
        $group['departments_id'] = 2;

        $response = $this->call('POST', '/api/admin/group_management/save/', array(
            'group' =>  $group,
        ));
        
        $response->assertStatus(200);
    }
}