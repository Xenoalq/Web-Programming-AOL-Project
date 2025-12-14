<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;


class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $artist_ids = Artist::pluck('artist_id')->toArray(); // Assuming ArtistSeeder runs first

        if (empty($artist_ids)) {
            // Optional: Handle case where no artists exist
            return; 
        }

        for ($i = 0; $i < 20; $i++) {
            DB::table('songs')->insert([
                'artist_id' => $faker->randomElement($artist_ids),
                'song_title' => $faker->catchPhrase(),
                'song_album' => $faker->firstName(),
                'song_lyric' => $faker->realText(500),
                'song_chord' => 'G C D Em', 
                'audio_url' => 'audio/song_' . $i . '.mp3', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
