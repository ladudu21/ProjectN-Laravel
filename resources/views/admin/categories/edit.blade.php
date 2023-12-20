@extends('admin.dashboard')
@section('content')
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
            <label for="name">Name</label>
        </div>
        @error('slug')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill">Edit</button>
    </form>
@endsection
