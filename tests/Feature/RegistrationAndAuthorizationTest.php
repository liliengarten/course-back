<?php


namespace Tests\Feature;

class RegistrationAndAuthorizationTest extends TestCase
{
    public function test_registration_with_complete_payload()
    {
        $payload = [
            'fio' => 'Гриффин Питер МакФинниган',
            'email' => 'takenemail@guy.com',
            'password' => 'emailtaken123.',
        ];

        $response = $this->postJson('/api/signup', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'user_token'
            ]
        ]);
    }

    public function test_registration_with_empty_payload()
    {
        $payload = [
            'fio' => '',
            'email' => '',
            'password' => '',
        ];

        $response = $this->postJson('/api/signup', $payload);
        $response->assertStatus(422);
    }

    public function test_registration_with_taken_email()
    {
        $payload = [
            'fio' => 'Гриффин Ритеп МакФинниган',
            'email' => 'takenemail@guy.com',
            'password' => 'emailtaken123.',
        ];

        $response = $this->postJson('/api/signup', $payload);
        $response->assertStatus(422);
    }

    public function test_registration_with_short_password()
    {
        $payload = [
            'fio' => 'Грейсон Марк Нолан',
            'email' => 'shortpassword@guy.com',
            'password' => 'a1.',
        ];

        $response = $this->postJson('/api/signup', $payload);
        $response->assertStatus(422);
    }

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

    public function test_logout()
    {
        $payload = [
            'email' => 'takenemail@guy.com',
            'password' => 'emailtaken123.',
        ];

        $token = (string)$this->postJson('/api/login', $payload)['data']['user_token'];
        $response = $this->withHeader('Authorization', "Bearer $token")->getJson("/api/logout");
        $response->assertStatus(200);
    }

}
