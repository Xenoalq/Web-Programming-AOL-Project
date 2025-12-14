@extends('layouts.app')

@section('content')
    <h2>🎧 Your Playlists</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <a href="{{ route('playlists.create') }}" class="btn btn-sm btn-success mb-3">
        + Create New Playlist
    </a>

    @if($playlists->isEmpty())
        <p class="alert alert-info">You haven't created any playlists yet.</p>
    @else
        <ul class="list-group">
            @foreach($playlists as $p)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{-- FIX 1: Use playlist_id for the route parameter --}}
                    {{-- FIX 2: Use play_name for display --}}
                    <a href="{{ route('playlists.show', $p->playlist_id) }}">
                        <strong>{{ $p->play_name }}</strong>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection