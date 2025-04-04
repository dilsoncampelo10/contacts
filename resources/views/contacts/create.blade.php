@extends('layouts.app')
@section('title','New Contact')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/contacts/index.css')}}">
@endpush
@section('content')
<div class="container-custom">
    <div class="brand-header">New Contact</div>
    <form method="POST" action="{{ route('contacts.store') }}">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Dilson Campêlo" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Ex: dilson@email.com" value="{{ old('email') }}" required>
      </div>

      <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" class="form-control" id="contact" name="contact" placeholder="Ex: 999938888" value="{{ old('contact') }}" required>
      </div>

      <div class="d-flex justify-content-between">
        <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">cancel</a>
        <button type="submit" class="btn btn-primary">Save Contact</button>
      </div>
    </form>
  </div>
@endsection