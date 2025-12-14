@extends('admin.layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📡 Live Event Management</h2>
        <a href="{{ route('admin.live.create') }}" class="btn btn-success">+ Schedule New Event</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Artist</th>
                <th scope="col">Stream URL</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event) {{-- Assuming the controller passes $events --}}
                <tr>
                    <td>{{ $event->live_id }}</td>
                    <td>{{ $event->live_title }}</td>
                    <td>{{ $event->live_artist }}</td>
                    <td><a href="{{ $event->stream_url }}" target="_blank">{{ Str::limit($event->stream_url, 40) }}</a></td>
                    <td>
                        <a href="{{ route('admin.live.edit', $event->live_id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                        
                        <form action="{{ route('admin.live.destroy', $event->live_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this live event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No live events scheduled.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $events->links() }}
</div>
@endsection