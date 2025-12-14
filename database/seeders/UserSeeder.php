<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'users_name' => 'Admin Boss',
            'users_email' => 'admin@spotifyclone.com', 
            'users_pass' => Hash::make('password'), // Use Hash::make() or bcrypt()
            'users_role' => 'admin',                // Set the role to 'admin'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'users_name'  => $faker->name(),
                'users_email' => $faker->unique()->safeEmail(),
                'users_pass'  => Hash::make('password'),
                'users_role'  => $faker->randomElement(['free', 'premium']),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
