@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Edit Live Event: {{ $event->live_title }}</h2>
    <a href="{{ route('admin.live.index') }}" class="btn btn-secondary mb-3">← Back to Events List</a>

    <form method="POST" action="{{ route('admin.live.update', $event->live_id) }}">
        @csrf 
        @method('PUT') 

        <div class="mb-3">
            <label for="live_title" class="form-label">Event Title</label>
            <input type="text" class="form-control @error('live_title') is-invalid @enderror" id="live_title" name="live_title" value="{{ old('live_title', $event->live_title) }}" required>
            @error('live_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="live_artist" class="form-label">Performing Artist</label>
            <input type="text" class="form-control @error('live_artist') is-invalid @enderror" id="live_artist" name="live_artist" value="{{ old('live_artist', $event->live_artist) }}" required>
            @error('live_artist')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="stream_url" class="form-label">Stream URL (e.g., YouTube Link)</label>
            <input type="url" class="form-control @error('stream_url') is-invalid @enderror" id="stream_url" name="stream_url" value="{{ old('stream_url', $event->stream_url) }}" required>
            @error('stream_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection