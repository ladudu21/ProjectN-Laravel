@extends('layouts.client-layout')
@section('content')
    <div class="container">
        <div class="card border-dark m-3">
            <div class="card-header">
                <h1>{{ $post->title }}</h1>
                <h6 class="card-subtitle text-muted mb-1">{{ $post->user->name }}</h6>
                <div class="card-subtitle">{{ $post->published_at }}</div>
            </div>

            <div class="card-body text-dark">
                <p class="card-text">{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
