<?php


namespace Tests\Feature;

class LoginUserTest extends TestCase
{
    public function test_login_with_complete_payload()
    {
        $payload = [
            'email' => 'test@test.test',
            'password' => 'secret123',
        ];

        $response = $this->postJson('/api/login', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'user_token'
            ]
        ]);
    }

    public function test_register_with_empty_payload()
    {
        $payload = [
            'fio' => '',
            'email' => '',
        ];

        $response = $this->postJson('/api/login', $payload);
        $response->assertStatus(422);
    }
}
