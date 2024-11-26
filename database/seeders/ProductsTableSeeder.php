<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 16, 17, 18, 19, 20, 22, 23, 24, 25, 26, 28, 29, 30, 31, 32, 34, 35, 36, 37, 38, 40, 41, 42, 43, 44, 46, 47, 48, 49, 51, 52, 53, 55, 56, 57];
        $faker = Factory::create();
        for ($j = 203; $j < 241; $j++) {
            $name = $faker->sentence(3);
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->sentences(3, true),
                'price' => $faker->randomFloat(2, 0, 250),
                'category_id' => $faker->randomElement($list),
                'image_url' => "/images/products/product-$j.jpg",
                'stock' => $faker->numberBetween(15, 99),
            ]);
        }
    }
}
