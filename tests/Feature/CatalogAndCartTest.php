<?php


namespace Tests\Feature;

class CatalogAndCartTest extends TestCase
{
    public function test_get_products()
    {
        $response = $this->getJson("/api/products");
        $response->assertStatus(200);
    }

    public function test_add_to_cart(): void{
        $payload = [
            'email' => 'takenemail@guy.com',
            'password' => 'emailtaken123.',
        ];

        $token = (string)$this->postJson('/api/login', $payload)['data']['user_token'];

        $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/cart/1");
        $response->assertStatus(201);
    }

    public function test_remove_from_cart(): void{
        $payload = [
            'email' => 'takenemail@guy.com',
            'password' => 'emailtaken123.',
        ];

        $token = (string)$this->postJson('/api/login', $payload)['data']['user_token'];

        $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/cart/1");
        $response->assertStatus(201);

        $cart = $this->withHeader('Authorization', "Bearer $token")->getJson("/api/cart");
        $cart->assertJsonStructure(['data']);
        $toDelete = 0;

        foreach ($cart['data'] as $item) {
            if ($item['product_id'] == 1) {
                $toDelete = $item['id'];
                break;
            }
        }

        $response = $this->withHeader('Authorization', "Bearer $token")->deleteJson("/api/cart/$toDelete");
        $response->assertStatus(200);
    }

    public function test_place_order()
    {
        $payload = [
            'email' => 'zxcv@zxcv.com',
            'password' => 'zxcv1234.',
        ];

        $token = (string)$this->postJson('/api/login', $payload)['data']['user_token'];

        for ($i = 1; $i <= 5; $i++) {
            $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/cart/$i");
            $response->assertStatus(201);
        }

        $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/order");
        $response->assertStatus(201);
    }

    public function test_place_order_with_empty_cart()
    {
        $payload = [
            'email' => 'zxcv@zxcv.com',
            'password' => 'zxcv1234.',
        ];

        $token = (string)$this->postJson('/api/login', $payload)['data']['user_token'];

        $response = $this->withHeader('Authorization', "Bearer $token")->postJson("/api/order");
        $response->assertStatus(422);
    }
}
