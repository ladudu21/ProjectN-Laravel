@extends('admin.dashboard')
@section('content')
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
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

        <div class="form-floating mb-3">
            @php
                $role_name = $user->getRoleNames()->implode('name', ', ');
            @endphp
            <select class="form-select" aria-label="Default select example" id="role" name="role">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $role->name == $role_name ? 'selected' : ''}}>{{ $role->name }}</option>
                @endforeach
            </select>
            <label for="role">Role</label>
        </div>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill">Edit</button>
    </form>
@endsection
