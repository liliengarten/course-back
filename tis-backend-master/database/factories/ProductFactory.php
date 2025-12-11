<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Request;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text(),
            'image' => $this->randomImg(),
            'price' => $this->faker->randomFloat(2, 1, 2000),
        ];
    }
    private function randomImg() {
        $imgArray = ['99ce37ec790741ad6a54a139c58706f3.jpg',
            '515831aec3fa50047741c68b170541ac.png',
            '6032631163.jpg',
            'cb6212a2336bffc42c7b6834a61e4540.jpeg',
            'fe055ca1-0613-4038-a275-2440aff13f8d.webp',
            'iStock-1158470655.jpg',
            'jfs0j9ivsls0sij9u77x13lc134keuwb.jpg',
            'kisspng-coca-cola-cherry-soft-drink.png',
            'shokolad-alpen-gold.jpg',
            'voda_0_5_l_plastikovaya_butylka_4_full.jpg'];
        return 'img/'.$imgArray[array_rand($imgArray)];
    }
}
