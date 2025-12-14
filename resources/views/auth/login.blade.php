@extends('layouts.app')
@section('content')
  <h2>Login</h2>
  <form method="POST" action="{{ route('login') }}">@csrf
    <div class="mb-3">
      <label>Email</label>
            <input name="email" class="form-control" value="{{ old('email') }}"> 
          </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control">
    </div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button class="btn btn-primary">Login</button>
  </form>
@endsection