@extends('admin.layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🧑‍🎤 Artist Management</h2>
        <a href="{{ route('admin.artists.create') }}" class="btn btn-success">+ Add New Artist</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Artist Name</th>
                <th scope="col">Total Songs</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($artists as $artist)
                <tr>
                    <td>{{ $artist->artist_id }}</td>
                    <td>{{ $artist->artist_name }}</td>
                    <td>{{ $artist->songs->count() }}</td> {{-- Requires the 'songs' relationship on Artist model --}}
                    <td>
                        <a href="{{ route('admin.artists.edit', $artist->artist_id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                        
                        {{-- Delete Form --}}
                        <form action="{{ route('admin.artists.destroy', $artist->artist_id) }}" method="POST" class="d-inline" onsubmit="return confirm('WARNING: Deleting an artist may orphan their songs. Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No artists found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $artists->links() }}
</div>
@endsection