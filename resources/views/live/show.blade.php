@extends('layouts.app')

@section('content')
    <a href="{{ route('live.index') }}" class="btn btn-sm btn-secondary mb-3">← Back to Events</a>

    <h2>{{ $event->live_title }}</h2>
    <p><strong>Artist:</strong> {{ $event->live_artist }}</p>
    
    {{-- Display the Streaming Link for visibility --}}
    <div class="mb-4">
        <p class="text-muted">Streaming link: {{ $event->stream_url }}</p>
    </div>

    {{-- The Join button/form --}}
    <form method="POST" action="{{ route('live.join', $event->live_id) }}">
        @csrf
        <button class="btn btn-success btn-lg">Join Live Stream Now</button>
    </form>
    
    {{-- Optionally, you can display the stream here after the user joins, 
    if your backend logic handles embedding the stream_url after the join action. --}}
    
@endsection