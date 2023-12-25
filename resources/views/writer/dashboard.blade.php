@extends('layouts.client-layout')
@section('content')
    <div class="d-flex justify-content-start">
        <div class="d-flex justify-content-start">
            <a class="btn btn-secondary m-3" href="{{ route('writer.posts.index') }}">Your posts</a>
        </div>
        <div class="d-flex justify-content-start">
            <a class="btn btn-secondary m-3" href="{{ route('writer.posts.create') }}">Create post</a>
        </div>
    </div>
    @if ($message = Session::get('message'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="container">
        @yield('sub-content')
    </div>
@endsection
