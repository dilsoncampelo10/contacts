@extends('layouts.app')
@section('title','Contacts')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/contacts/index.css')}}">
@endpush
@section('content')
<div class="container-custom">
    <div class="brand-header"><i class="fa-solid fa-address-book"></i> Contact List</div>

    <div class="d-flex justify-content-between mb-4">
      <form class="d-flex" method="GET" action="{{ route('contacts.index') }}">
        <input type="text" name="search" class="form-control me-2" placeholder="Search contact...">
        <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> </button>
      </form>
      <a href="{{ route('contacts.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New Contact</a>
    </div>
    <a href="{{route('contacts.index')}}" class="mb-3">Limpar Filtros</a>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Contact</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($contacts as $contact)
            <tr>
              <td>{{$contact->id}}</td>
              <td>{{ $contact->name }}</td>
              <td>{{ $contact->email }}</td>
              <td>{{ $contact->contact }}</td>
              <td class="text-end">
                <div class="btn-actions justify-content-end">
                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-circle-info"></i> View</a>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this contact?')"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                    </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted">Contacts Not Found</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($contacts->hasPages())
      <div class="d-flex justify-content-center mt-4">
        {{ $contacts->links() }}
      </div>
    @endif
  </div>
@endsection