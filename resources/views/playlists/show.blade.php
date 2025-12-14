@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('playlists.index') }}" class="btn btn-sm btn-secondary mb-3">← Back to Playlists</a>
    
    {{-- FIX 1: Use custom column name play_name --}}
    <h2>🎧 Playlist: {{ $playlist->play_name }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- --------------------------------------- --}}
    <h3>Current Songs ({{ $playlist->songs->count() }})</h3>
    {{-- --------------------------------------- --}}

    @if ($playlist->songs->isEmpty())
        <p class="alert alert-warning">This playlist is currently empty.</p>
    @else
        <ul class="list-group mb-5">
            @foreach($playlist->songs as $song)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {{-- FIX 2: Use custom column name song_title --}}
                        <strong>{{ $song->song_title }}</strong> 
                        {{-- FIX 3: Access the artist name via the 'artist' relationship --}}
                        - {{ $song->artist->artist_name ?? 'Unknown Artist' }}
                    </div>
                    
                    {{-- Remove Button Form --}}
                    <form method="POST" action="{{ route('playlists.removeSong', ['id' => $playlist->playlist_id, 'songId' => $song->song_id]) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this song?');">
                        @csrf 
                        @method('DELETE')
                        {{-- FIX 4: Use correct IDs for the route parameters --}}
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
    
    {{-- --------------------------------------- --}}
    <h3>Add Song to Playlist</h3>
    {{-- --------------------------------------- --}}
    
    {{-- You will need to pass $allSongs from the controller to populate this dropdown --}}
    <form method="POST" action="{{ route('playlists.addSong', $playlist->playlist_id) }}">
        @csrf
        
        <div class="input-group">
            <select name="song_id" class="form-select @error('song_id') is-invalid @enderror" required>
                <option value="">Select a Song...</option>
                {{-- Assuming $allSongs is passed from the controller, and uses song_id --}}
                @foreach ($allSongs as $song)
                    <option value="{{ $song->song_id }}">
                        {{ $song->song_title }} by {{ $song->artist->artist_name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">Add</button>
            @error('song_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </form>

</div>
@endsection