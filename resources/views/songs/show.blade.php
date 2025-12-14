@extends('layouts.app')
@section('title', $song->song_title)
@section('content')

    <h1>{{ $song->song_title }}</h1>
    <p><strong>Artist:</strong> {{ $song->artist->artist_name ?? 'Unknown Artist' }}</p>

    <audio controls style="width:100%">
        <source src="{{ asset('storage/' . $song->audio_url) }}" type="audio/mpeg">
    </audio>

    <p class="mt-2">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('songs.lyrics',$song->song_id) }}">View Lyrics</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('songs.chords',$song->song_id) }}">View Chords</a>
    </p>

    @if(Auth::check() && isset($userPlaylists) && $userPlaylists->count() > 0)
        <form method="POST" action="{{ route('playlists.addSong', '__REPLACE_ME__') }}" id="add-to-playlist-form">
            @csrf
            {{-- Use custom primary key song_id --}}
            <input type="hidden" name="song_id" value="{{ $song->song_id }}">
            
            <div class="input-group mt-3" style="max-width: 300px;">
                <select name="id" class="form-select" required onchange="document.getElementById('add-to-playlist-form').action = '{{ url('playlists') }}/' + this.value + '/songs';">
                    <option value="">Add to Playlist...</option>
                    @foreach ($userPlaylists as $playlist)
                        {{-- Use custom playlist_id and play_name --}}
                        <option value="{{ $playlist->playlist_id }}">{{ $playlist->play_name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary btn-sm" type="submit">Add</button>
            </div>
        </form>
    @elseif (Auth::check())
        <p class="text-muted mt-3">You need to <a href="{{ route('playlists.create') }}">create a playlist</a> first to add this song.</p>
    @else
        <p class="text-muted mt-3"><a href="{{ route('login') }}">Log in</a> to add this song to a playlist.</p>
    @endif
@endsection