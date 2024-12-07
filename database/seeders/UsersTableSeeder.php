<?php

namespace Database\Seeders;
use \App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Loop to create 10,000 users
        for ($i = 0; $i < 10000; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Use a simple password or a hashed one
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
