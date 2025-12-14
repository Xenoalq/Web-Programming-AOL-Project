<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    //
    protected $primaryKey = 'song_id';

    protected $fillable = [
        'artist_id', 'song_title', 'song_album', 'song_lyric', 'song_chord', 'audio_url'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'artist_id');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_songs', 'song_id', 'playlist_id');
    }
}
