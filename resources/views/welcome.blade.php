@extends('layouts.client-layout')
@section('content')
    <div class="row isotope-grid">
        @foreach ($posts as $post)
            <div class="card m-3" style="width: 18rem;">
                <img src="{{ asset($post->thumb) }}" class="card-img-top" alt="...">
                <div class="card-body mb-2">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <a href="{{ route('post.show', $post->slug) }}" class="card-link">Read</a>
                </div>
                <div class="blockquote-footer"> Author: {{ $post->user->name }}</div>
                <div class="blockquote-footer"> {{ $post->likes->count() }} likes</div>
                <div class="card-footer text-muted">
                    At {{ $post->published_at }}
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
@endsection
