<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class MsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++){
            $users = [
                'user_in' => $faker->name,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => '628'.$faker->numerify('##########'),
                'image_url' => $faker->imageUrl('50', '50', 'animal'),
                'email' => $faker->email(),
                'password' => Hash::make('#abc.123'),
                'role' => $faker->randomElement(['staff', 'member'])
            ];

            User::insert($users);
        }
    }
}
