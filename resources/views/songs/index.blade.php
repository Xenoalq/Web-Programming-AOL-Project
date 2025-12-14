@extends('layouts.app')
@section('title','Songs')
@section('content')
    <h2>All Songs</h2>
    <form action="{{ route('songs.index') }}" method="GET" class="search-form">
    <div class="input-group">
        <input 
            type="text" 
            name="q" 
            class="form-control" 
            placeholder="Search for songs..."
            value="{{ request('q') }}" {{-- Optional: keeps the search term in the box after search --}}
        >
        <button type="submit" class="btn btn-primary">Search</button>
        
        {{-- Optional: A way to clear the search filter --}}
        @if(request('q'))
            <a href="{{ route('songs.index') }}" class="btn btn-secondary">Clear</a>
        @endif
      </div>
    </form>

    <div class="row">
        @foreach($songs as $song)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        {{-- FIX 1: Use song_id for the route and song_title for display --}}
                        <h5 class="card-title"><a href="{{ route('songs.show',$song->song_id) }}">{{ $song->song_title }}</a></h5>
                        {{-- FIX 2: Access artist name via relationship --}}
                        <p class="card-text">{{ $song->artist->artist_name ?? 'Unknown Artist' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination Links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $songs->links() }}
    </div>
@endsection