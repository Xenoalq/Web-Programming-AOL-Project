<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
      <img src="{{ asset('images/beatwayzfree.jpg') }}" alt="BeatWayz Logo" height="40" class="me-2">
      <span class="fw-bold text-primary">BeatWayz</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('songs.index') }}">Songs</a></li>
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('playlists.index') }}">Playlists</a></li>
        @endauth
        <li class="nav-item"><a class="nav-link" href="{{ route('live.index') }}">Live</a></li>
      </ul>

      <ul class="navbar-nav">
        @auth
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">@csrf
              <button class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
