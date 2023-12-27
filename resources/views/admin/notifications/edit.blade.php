@extends('admin.dashboard')
@section('content')
    <form action="{{ route('admin.notifications.update', $notification->message_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="message" name="message" value="{{ $notification->data->message }}">
            <label for="name">Message</label>
        </div>
        @error('slug')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary rounded-pill">Edit</button>
    </form>
    <div class="container mt-3">
        <h5>Recipient</h5>
        @foreach ($user_list as $user)
            <p>{{ $user }}</p>
        @endforeach
    </div>
@endsection
