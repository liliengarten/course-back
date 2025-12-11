<?php


namespace Tests\Feature;

class AuthorizationUserTest extends TestCase
{
    public function test_authorization_with_complete_payload()
    {
        $payload = [
            'email' => 'takenemail@guy.com',
            'password' => 'emailtaken123.',
        ];

        $response = $this->postJson('/api/login', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'user_token'
            ]
        ]);
    }

    public function test_authorization_with_empty_payload()
    {
        $payload = [
            'fio' => '',
            'email' => '',
        ];

        $response = $this->postJson('/api/login', $payload);
        $response->assertStatus(422);
    }

    public function test_authorization_with_incorrect_payload()
    {
        $payload = [
            'email' => 'john@doe.com',
            'password' => 'iamnotreal',
        ];

        $response = $this->postJson('/api/login', $payload);
        $response->assertStatus(401);
    }

}
