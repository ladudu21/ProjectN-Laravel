@extends('admin.dashboard')
@section('title', 'Add category')
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            <label for="name">Name</label>
        </div>
        @error('slug')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill">Add</button>
    </form>
@endsection
