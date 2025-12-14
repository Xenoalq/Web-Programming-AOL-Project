<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Live;

class LiveMusicController extends Controller
{
    public function PublicIndex()
    {
        $events = Live::all();
        return view('live.index', compact('events'));
    }

    public function show($id)
    {
        $event = Live::findOrFail($id);
        return view('live.show', compact('event'));
    }

    public function join($id)
    {
   
        $liveEvent = Live::findOrFail($id);
        return redirect()->route('live.show', ['id' => $id])
                        ->with('success', 'You have successfully joined the live session!');
    }

    public function create()
    {
        return view('admin.live.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'live_title' => 'required|string|max:50',
            'live_artist' => 'required|string|max:50',
            'stream_url' => 'required|url|max:50', // Use 'url' validation rule
        ]);

        Live::create($validatedData);

        return redirect()->route('admin.live.index')->with('success', 'Live event created.');
    }


    public function edit($id)
    {
        $event = Live::findOrFail($id);
        return view('admin.live.edit', compact('event'));
    }

 
    public function update(Request $request, $id)
    {
        $event = Live::findOrFail($id);

        $validatedData = $request->validate([
            'live_title' => 'required|string|max:50',
            'live_artist' => 'required|string|max:50',
            'stream_url' => 'required|url|max:50',
        ]);

        $event->update($validatedData);

        return redirect()->route('admin.live.index')->with('success', 'Live event updated.');
    }

    public function destroy($id)
    {
        Live::findOrFail($id)->delete();

        return redirect()->route('admin.live.index')->with('success', 'Live event deleted.');
    }

    public function index()
    {
        // Pastikan Anda memuat data dengan pagination jika datanya banyak
        $events = Live::paginate(15); 
        
        // GANTI PATH VIEW INI:
        return view('admin.live.index', compact('events')); 
        // Seharusnya: resources/views/admin/live/index.blade.php
    }
}
