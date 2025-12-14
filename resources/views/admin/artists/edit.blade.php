@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Edit Artist: {{ $artist->artist_name }}</h2>
    <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary mb-3">← Back to Artist List</a>

    <form method="POST" action="{{ route('admin.artists.update', $artist->artist_id) }}">
        @csrf 
        @method('PUT') 

        <div class="mb-3">
            <label for="artist_name" class="form-label">Artist Name</label>
            <input type="text" class="form-control @error('artist_name') is-invalid @enderror" id="artist_name" name="artist_name" value="{{ old('artist_name', $artist->artist_name) }}" required>
            @error('artist_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Artist</button>
    </form>
</div>
@endsection