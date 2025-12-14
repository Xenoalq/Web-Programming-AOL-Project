<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('lives')->insert([
                'live_title'  => $faker->sentence(3),
                'live_artist' => $faker->name(),
                'stream_url'  => $faker->url(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
