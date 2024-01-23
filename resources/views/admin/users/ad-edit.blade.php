@extends('admin.dashboard')
@section('title', 'Edit admin')
@section('content')
    <form action="{{ route('admin.users.ad_update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            <label for="email">Email</label>
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            <label for="name">Name</label>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill">Edit</button>
    </form>
@endsection
