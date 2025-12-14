<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist;

class SearchController extends Controller 
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $grouped = $request->boolean('grouped');

        if ($grouped) {

            $songs = Song::when($search, function ($query, $search) {
                    $query->where('song_name', 'like', "%{$search}%")
                          ->orWhere('song_artist', 'like', "%{$search}%"); 
                })
                ->orderBy('song_name') 
                ->get()
                ->groupBy('song_name');

            return view('songs.grouped', compact('songs', 'search'));
        } else {

            $artists = Artist::when($search, function ($query, $search) {
                    $query->where('artist_name', 'like', "%{$search}%");
                })
                ->paginate(10);

            return view('artists.index', compact('artists', 'search'));
        }
    }
}