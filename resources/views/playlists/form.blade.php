@extends('layouts.app')

@section('content')
    <a href="{{ route('playlists.index') }}" class="btn btn-sm btn-secondary mb-3">← Back to Playlists</a>

    <h2>✨ Create New Playlist</h2>
    
    <form method="POST" action="{{ route('playlists.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Playlist Name</label>
            {{-- Input name 'name' is correct, as your controller expects $request->validate(['name' => ...]) --}}
            <input name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary">Create Playlist</button>
    </form>
@endsection