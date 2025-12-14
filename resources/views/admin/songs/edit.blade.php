@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Edit Song: {{ $song->song_title }}</h2>
    <a href="{{ route('admin.songs.index') }}" class="btn btn-secondary mb-3">← Back to Song List</a>

    <form method="POST" action="{{ route('admin.songs.update', $song->song_id) }}" enctype="multipart/form-data">
        @csrf 
        @method('PUT') 

        {{-- Artist Dropdown --}}
        <div class="mb-3">
            <label for="artist_id" class="form-label">Artist</label>
            <select class="form-control @error('artist_id') is-invalid @enderror" id="artist_id" name="artist_id" required>
                <option value="">Select Artist</option>

                @foreach ($artists as $artist)
                    <option value="{{ $artist->artist_id }}" 
                        {{ (old('artist_id') == $artist->artist_id || $song->artist_id == $artist->artist_id) ? 'selected' : '' }}>
                        {{ $artist->artist_name }}
                    </option>
                @endforeach
            </select>
            @error('artist_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Song Title --}}
        <div class="mb-3">
            <label for="song_title" class="form-label">Title</label>
            <input type="text" class="form-control @error('song_title') is-invalid @enderror" id="song_title" name="song_title" value="{{ old('song_title', $song->song_title) }}" required>
            @error('song_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Song Album --}}
        <div class="mb-3">
            <label for="song_album" class="form-label">Album</label>
            <input type="text" class="form-control @error('song_album') is-invalid @enderror" id="song_album" name="song_album" value="{{ old('song_album', $song->song_album) }}" required>
            @error('song_album')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Audio File Upload (Optional update) --}}
        <div class="mb-3">
            <label for="audio_file" class="form-label">Replace Audio File (MP3/M4A)</label>
            <input type="file" class="form-control @error('audio_file') is-invalid @enderror" id="audio_file" name="audio_file">
            <small class="form-text text-muted">Current File: {{ $song->audio_url ? $song->audio_url : 'None' }}</small>
            @error('audio_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        
        {{-- Lyrics --}}
        <div class="mb-3">
            <label for="song_lyric" class="form-label">Lyrics</label>
            <textarea class="form-control @error('song_lyric') is-invalid @enderror" id="song_lyric" name="song_lyric" rows="6" required>{{ old('song_lyric', $song->song_lyric) }}</textarea>
            @error('song_lyric')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Chords --}}
        <div class="mb-4">
            <label for="song_chord" class="form-label">Chords</label>
            <textarea class="form-control @error('song_chord') is-invalid @enderror" id="song_chord" name="song_chord" rows="4" required>{{ old('song_chord', $song->song_chord) }}</textarea>
            @error('song_chord')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Song</button>
    </form>
</div>
@endsection