<?php

namespace Database\Seeders;

use App\Models\brands;
use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Config;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $value) {
            products::create([
                'name' => $faker->randomElement(brands::pluck('name')),
                'price' => $faker->numberBetween($min = 5000, $max = 100000),
                'sale_price' => $faker->numberBetween($min = 500, $max = 4999),
                'color' => $faker->colorName,
                'brand_id' => $faker->randomElement(brands::pluck('id')),
                'product_code' => $faker->numerify('WHC-#####'),
                'gender' => $faker->randomElement(['Male', 'Female', 'Children', 'Unisex']),
                'function' => $faker->randomElement(Config::get('watch_function')),
                'stock' => $faker->randomDigit(),
                'description' => $faker->text($maxNbChars = 200),
                'image' => $faker->imageUrl($width = 640, $height = 480),
                'is_active' => $faker->randomElement(['1', '0']),
            ]);
        }
    }
}
