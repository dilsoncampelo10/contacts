@extends('layouts.app')
@section('title','Edit Contact')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/contacts/edit.css')}}">
@endpush
@section('content')
<div class="container-custom">
    <div class="brand-header">Edit Contact</div>
    <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $contact->name) }}" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $contact->email) }}" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Contact</label>
        <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $contact->contact) }}" required>
      </div>

      <div class="d-flex justify-content-between">
        <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Contact</button>
      </div>
    </form>
  </div>
@endsection