<?php

namespace Tests\Feature;

class RegisterUserTest extends TestCase
{
    public function test_user_can_register_via_api()
    {
        $payload = [
            'fio' => 'Test User',
            'email' => 'test@test.test',
            'password' => 'secret123',
        ];

        $response = $this->postJson('/api/signup', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'user_token'
            ]
        ]);
    }

    public function test_register_with_taken_email()
    {
        $payload = [
            'fio' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'adminadmin',
        ];

        $response = $this->postJson('/api/signup', $payload);

        $response->assertStatus(422);
        $response->assertJsonStructure([]); //errors
    }

    public function test_register_with_empty_payload()
    {
        $payload = [
            'fio' => '',
            'email' => '',
            'password' => '',
        ];

        $response = $this->postJson('/api/signup', $payload);
        $response->assertStatus(422);
    }
}
