<?php

namespace Tests\Feature;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\RetrainingInfo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetrainingManagementEditTest extends TestCase
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

        $retraining['id'] = RetrainingInfo::orderBy('id', 'desc')->first()->id;
        $retraining['title'] = "Название доп образования";
        $retraining['href'] = "https://mpt.ru/upload/head.jpg";
        $retraining['cost'] = 30000;
        $retraining['time'] = "72 академических часа";
        $retraining['text'] = "Текст доп образования";

        $response = $this->call('POST', '/api/admin/retraining_management/edit/'.$retraining['id'], array(
            'retraining' =>  $retraining,
        ));

        $response->assertStatus(200);
    }
}