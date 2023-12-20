@extends('admin.dashboard')
@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            <label for="email">Email</label>
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password">
            <label for="password">Password</label>
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            <label for="name">Name</label>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating mb-3">
            <select class="form-select" aria-label="Default select example" id="role" name="role">
                <option value="" disabled selected>Select an option</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <label for="role">Role</label>
        </div>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill">Add</button>
    </form>
@endsection
