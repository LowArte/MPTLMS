<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetrainingManagementAddTest extends TestCase
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

        $retraining['id'] = -1;
        $retraining['title'] = "Название доп образования";
        $retraining['href'] = "https://mpt.ru/upload/head.jpg";
        $retraining['cost'] = 30000;
        $retraining['time'] = "72 академических часа";
        $retraining['text'] = "Текст доп образования";

        $response = $this->call('POST', '/api/admin/retraining_management/save/', array(
            'retraining' =>  $retraining,
        ));
        
        $response->assertStatus(200);
    }
}