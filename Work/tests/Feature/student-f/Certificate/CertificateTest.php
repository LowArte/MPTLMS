<?php

namespace Tests\Feature\Student;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CertificateTest extends TestCase
{
    use DatabaseTransactions;
    public function testCertificate()
    {
        $user = User::Find(1);
        $response = $this->actingAs($user);
        $response = $this->get('/student/certificate');
        $response->assertStatus(200);
    }

    public function testSaveCertificate()
    {
        Passport::actingAs(
            User::Find(2),
            ['create-servers']
        );

        $data = array("Текст" => "Текст заявки");
        $type = "Справка";

        $response = $this->call('POST', '/api/save/certificate/', array(
            "data" => $data, 
            "type" => $type
        ));
        
        $response->assertStatus(200);
    }
}