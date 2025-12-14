<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','BeatWayz')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  @include('partials.navbar')
  <div class="container mt-4">
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @yield('content')
  </div>
  @include('partials.now-playing')
  @include('partials.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
