@extends('layouts.auth')
@section('title','Login')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/auth/login.css')}}">
@endpush
@section('content')

<div class="login-card">
    <div class="brand-logo">
      Dilson
    </div>
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="text" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required autofocus>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password Confirmation</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
      </div>

     
      <button type="submit" class="btn btn-primary w-100">Register</button>

      <div class="text-center mt-3">
        <a href="{{route('login')}}" class="text-decoration-none text-muted">
            Already have an account? Sign in
        </a>
      </div>
    </form>
  </div>
@endsection