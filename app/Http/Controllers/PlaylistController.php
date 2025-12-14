<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class PlaylistController extends Controller
{
    public function index()
    {

        $userId = Auth::user()->users_id;
        $playlists = Playlist::where('users_id', $userId)->get();
        
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        return view('playlists.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist = Playlist::forceCreate([
            'users_id'   => Auth::user()->users_id,
            'play_name' => $data['name']
        ]);

        return redirect()->route('playlists.show', $playlist->playlist_id);
    }

    public function show($id)
    {
        
        $playlist = Playlist::with(['songs.artist'])
                            ->where('playlist_id', $id)
                            ->first();

        if (!$playlist) {
            return redirect()->route('playlists.index')->with('error', 'Playlist not found');
        }

        $allSongs = Song::with('artist')->orderBy('song_title')->get();

        return view('playlists.show', compact('playlist', 'allSongs'));

        
    }

    public function addSong(Request $request, $id)
    {
        $request->validate(['song_id' => 'required|integer|exists:songs,song_id']);

        $playlist = Playlist::where('playlist_id', $id)->first();
        
        if ($playlist) {

            $playlist->songs()->attach($request->song_id);
        }

        return back();
    }

    public function removeSong($id, $songId)
    {
        $playlist = Playlist::where('playlist_id', $id)->first();
        
        if ($playlist) {
            $playlist->songs()->detach($songId);
        }
        
        return back();
    }
}