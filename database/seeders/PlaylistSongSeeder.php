<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Playlist; 
use App\Models\Song;

class PlaylistSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playlists = Playlist::all();
        $songs = Song::pluck('song_id')->toArray();

        foreach ($playlists as $playlist) {
            $randomSongs = collect($songs)->random(rand(2, 6));

            foreach ($randomSongs as $song) {
                DB::table('playlist_songs')->insert([
                    'playlist_id' => $playlist->playlist_id,
                    'song_id'     => $song,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
