<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.songs.index') }}">
      <img src="{{ asset('images/beatwayzfree.jpg') }}" alt="Admin Logo" height="40" class="me-2">
      <span class="fw-bold text-warning">ADMIN PANEL</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="adminNavbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        {{-- Admin: SONG MANAGEMENT --}}
        <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.songs.*') ? 'active text-light' : 'text-secondary' }}" 
             href="{{ route('admin.songs.index') }}">
             <i class="bi bi-music-note-list me-1"></i> Songs
          </a>
        </li>
        
        {{-- Admin: ARTIST MANAGEMENT --}}
        <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.artists.*') ? 'active text-light' : 'text-secondary' }}" 
             href="{{ route('admin.artists.index') }}">
             <i class="bi bi-person-fill me-1"></i> Artists
          </a>
        </li>
        
        {{-- Admin: LIVE EVENT MANAGEMENT --}}
        <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.live.*') ? 'active text-light' : 'text-secondary' }}" 
             href="{{ route('admin.live.index') }}">
             <i class="bi bi-broadcast me-1"></i> Live Events
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          {{-- kembali ke halaman depan user --}}
          <li class="nav-item me-3">
             <a class="btn btn-sm btn-info" href="{{ route('songs.index') }}">
                <i class="bi bi-house-door-fill"></i> View User Site
             </a>
          </li>
          
          {{-- Tombol Logout --}}
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">@csrf
              <button type="submit" class="btn btn-sm btn-outline-danger">Logout ({{ Auth::user()->name ?? 'Admin' }})</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>