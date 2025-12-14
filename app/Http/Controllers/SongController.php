<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist; // Needed for create() and edit()
use App\Models\Playlist; // Needed for show()
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    public function PublicIndex(Request $request)
    {
        $q = $request->query('q');
    
        $songs = Song::when($q, function($query) use ($q) {
            $query->where('song_title', 'like', "%{$q}%"); 
        })->paginate(12);

        return view('songs.index', compact('songs'));
    }

    public function show($id)
    {
        $song = Song::with('artist')->where('song_id', $id)->first();

        if (!$song) {
            abort(404);
        }
        
        $userPlaylists = collect(); 
        if (Auth::check()) {
 
            $userPlaylists = Playlist::where('users_id', Auth::user()->users_id)->get();
        }

        return view('songs.show', compact('song', 'userPlaylists'));
    }

    public function lyrics($id)
    {

        $song = Song::find($id);

        if (is_null($song)) {
            abort(404);
        }

        return view('songs.lyrics', compact('song'));
    }

    public function chords($id)
    {
  
        $song = Song::firstWhere('song_id', $id);

        if (!$song) {
            return redirect()->route('songs.index'); 
        }

        return view('songs.chords', compact('song'));
    }

    public function create()
    {
    
        $artists = Artist::orderBy('artist_name')->get();
        return view('admin.songs.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'artist_id' => 'required|exists:artists,artist_id',
            'song_title' => 'required|string|max:50',
            'song_album' => 'required|string|max:50',
            'song_lyric' => 'required|string',
            'song_chord' => 'required|string',
            'audio_file' => 'required|file|mimes:mp3,m4a|max:20480', // Max 20MB
        ]);

        $path = null;
        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('audio', 'public');
        }
        
        $song = Song::create(array_merge($validatedData, [
            'audio_url' => $path,
        ]));

        return redirect()->route('admin.songs.index')
                        ->with('success', 'Song created successfully.');
    }

    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $artists = Artist::orderBy('artist_name')->get();
        return view('admin.songs.edit', compact('song', 'artists'));
    }

    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);

        $validatedData = $request->validate([
            'artist_id' => 'required|exists:artists,artist_id',
            'song_title' => 'required|string|max:50',
            'song_album' => 'required|string|max:50',
            'song_lyric' => 'required|string',
            'song_chord' => 'required|string',
        ]);

        $song->update($validatedData);

        return redirect()->route('admin.songs.index')
                         ->with('success', 'Song updated successfully.');
    }


    public function destroy($id)
    {
        Song::findOrFail($id)->delete();

        return redirect()->route('admin.songs.index')
                         ->with('success', 'Song deleted successfully.');
    }


    public function index()
    {
 
        $songs = Song::with('artist')->latest('song_id')->paginate(15); 
        return view('admin.songs.index', compact('songs'));
    }

}