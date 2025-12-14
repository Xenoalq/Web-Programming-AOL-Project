@extends('admin.layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Song Management (Admin)</h2>
        
        {{-- Button to trigger the Create Form --}}
        <a href="{{ route('admin.songs.create') }}" class="btn btn-success">
            + Add New Song
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Song List Table --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Album</th>
                    <th scope="col">File Path</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($songs as $song)
                    <tr>
                        <th scope="row">{{ $song->song_id }}</th>
                        <td>{{ $song->song_title }}</td>
                        <td>{{ $song->artist->artist_name ?? 'N/A' }}</td>
                        <td>{{ $song->song_album }}</td>
                        <td>
                            @if ($song->audio_url)
                                {{-- For display only, truncate long paths --}}
                                <span title="{{ $song->audio_url }}">{{ Str::limit($song->audio_url, 30) }}</span> 
                            @else
                                <span class="text-danger">MISSING FILE</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.songs.edit', $song->song_id) }}" class="btn btn-sm btn-primary me-2">
                                Edit
                            </a>
                            <form action="{{ route('admin.songs.destroy', $song->song_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this song?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No songs found in the catalog. Start by adding one!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination Links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $songs->links() }}
    </div>

</div>
@endsection