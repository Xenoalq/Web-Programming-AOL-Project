<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //
    protected $primaryKey = 'playlist_id';

    protected $fillable = [
        'users_id', 'play_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_songs', 'playlist_id', 'song_id');
    }
}
