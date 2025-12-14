@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Add New Artist</h2>
    <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary mb-3">← Back to Artist List</a>

    <form method="POST" action="{{ route('admin.artists.store') }}">
        @csrf 

        <div class="mb-3">
            <label for="artist_name" class="form-label">Artist Name</label>
            <input type="text" class="form-control @error('artist_name') is-invalid @enderror" id="artist_name" name="artist_name" value="{{ old('artist_name') }}" required>
            @error('artist_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Artist</button>
    </form>
</div>
@endsection