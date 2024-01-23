@extends('admin.dashboard')
@section('title', 'Assign role')
@section('content')
    <form action="{{ route('admin.authorizations.assign_role') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <select class="form-select target" aria-label="Default select example" id="user" name="user">
                <option value="" disabled selected>Select user to assign</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <label for="role">Users</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select target" aria-label="Default select example" id="role" name="role">
                <option value="" disabled selected>Select role to assign</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <label for="role">Role</label>
        </div>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill mt-3">Assign</button>
    </form>
@endsection
