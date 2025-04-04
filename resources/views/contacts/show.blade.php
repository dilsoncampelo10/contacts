@extends('layouts.app')
@section('title','Contact Details')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/contacts/show.css')}}">
@endpush
@section('content')

<div class="container-custom">
    <div class="detail-title">Contact Details</div>

    <div class="detail-item">
      <span class="detail-label">Nome:</span> {{ $contact->name }}
    </div>

    <div class="detail-item">
      <span class="detail-label">E-mail:</span> {{ $contact->email }}
    </div>

    <div class="detail-item">
      <span class="detail-label">Contact:</span> {{ $contact->contact }}
    </div>

    <div class="d-flex justify-content-between mt-4">
      <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary">Edit</a>

      <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger">Delete</button>
      </form>
    </div>

    <div class="text-center mt-3">
      <a href="{{ route('contacts.index') }}" class="btn btn-link"><i class="fa-solid fa-backward"></i> Back to contact list</a>
    </div>
  </div>
@endsection