<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        Product::create([
//            'name'=>'Яблоко',
//            'description'=>'Красное яблоко',
//            'price'=>100,
//        ]);
//
//        Product::create([
//            'name'=>'Банан',
//            'description'=>'Бан',
//            'price'=>400,
//        ]);
//
//        Product::create([
//            'name'=>'Еда',
//            'description'=>'Вкусная еда',
//            'price'=>5000,
//        ]);
        Product::factory(50)->create();
        User::create([
            'fio'=>'admin',
            'email'=>'admin@admin.com',
            'password'=> Hash::make('password'),
        ])->carts()->create([]);

        User::create([
            'fio'=>'user',
            'email'=>'user@user.com',
            'password'=> Hash::make('password'),
        ])->carts()->create([]);
    }
}
