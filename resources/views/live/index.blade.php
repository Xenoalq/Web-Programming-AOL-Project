@extends('layouts.app')

@section('content')
<h2>Live Events</h2>
    
    @if ($events->isEmpty())
        <p class="alert alert-info">No live events are currently scheduled.</p>
    @else
        <ul class="list-group">
            @foreach($events as $event)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{-- FIX: Use live_show route and the correct PK (live_id) --}}
                    <a href="{{ route('live.show', $event->live_id) }}">
                        {{-- FIX: Use correct columns (live_title and live_artist) --}}
                        <strong>{{ $event->live_title }}</strong> by {{ $event->live_artist }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection