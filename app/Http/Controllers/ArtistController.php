<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{

    public function index()
    {
        $artists = Artist::paginate(15);
        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artists.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'artist_name' => 'required|string|max:50|unique:artists,artist_name',
        ]);

        Artist::create($validatedData);

        return redirect()->route('admin.artists.index')
                         ->with('success', 'Artist created successfully.');
    }

    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('admin.artists.edit', compact('artist'));
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $validatedData = $request->validate([
            'artist_name' => 'required|string|max:50|unique:artists,artist_name,' . $id . ',artist_id',
        ]);

        $artist->update($validatedData);

        return redirect()->route('admin.artists.index')
                         ->with('success', 'Artist updated successfully.');
    }

    public function destroy($id)
    {
        Artist::findOrFail($id)->delete();

        return redirect()->route('admin.artists.index')
                         ->with('success', 'Artist deleted successfully.');
    }
    
}