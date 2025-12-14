@extends('layouts.app')
@section('content')
    <a href="{{ route('songs.show', $song->song_id) }}" class="btn btn-sm btn-secondary mb-3">← Back to Song</a>
    <h2>Chords: {{ $song->song_title }}</h2>
    <pre style="white-space: pre-wrap; word-wrap: break-word;">{{ $song->song_chord ?? 'No chords available.' }}</pre>
@endsection