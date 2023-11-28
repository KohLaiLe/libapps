<?php

namespace Database\Seeders;

use App\Models\MsBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MsBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0 ; $i < 30 ; $i++){
            $books = [
                'user_in' => $faker->name,
                'title' => $faker->sentence('6'),
                'author' => $faker->name,
                'isbn' => $faker->isbn13(),
                'description' => $faker->realText('50'),
                'image_url' => $faker->imageUrl('21', '27', 'book'),
                'category' => $faker->randomElement(['science', 'fiction', 'language']),
            ];

            MsBook::insert($books);
        }
    }
}
