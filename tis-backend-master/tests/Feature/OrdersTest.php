<?php

namespace Tests\Feature;

class OrdersTest extends TestCase
{
    public function test_place_order()
    {
        $payload = [
            'email' => 'test@test.test',
            'password' => 'secret123',
        ];

        $token = (string)$this->postJson('/api/login', $payload)['data']['user_token'];

        for ($i = 1; $i <= 5; $i++) {
            $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/cart/$i");
            $response->assertStatus(201);
        }

        $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/order");
        $response->assertStatus(201);
    }
}
