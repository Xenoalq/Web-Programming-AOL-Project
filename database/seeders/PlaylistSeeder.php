<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $user_ids = User::pluck('users_id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('playlists')->insert([
                'users_id'   => $faker->randomElement($user_ids),
                'play_name'  => $faker->words(2, true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
