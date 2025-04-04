@extends('layouts.auth')
@section('title','Login')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/auth/login.css')}}">
@endpush
@section('content')

<div class="login-card">
    <div class="brand-logo">
      Domnis
    </div>
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>

      <button type="submit" class="btn btn-primary w-100">Sign in</button>

      <div class="text-center mt-3">
        <a href="{{route('register')}}" class="text-decoration-none text-muted">
            Don't have a login? Register
        </a>
      </div>
    </form>
  </div>
@endsection