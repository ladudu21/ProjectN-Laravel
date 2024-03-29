@extends('layouts.client-layout')
@section('content')
    <div class="container mt-3">
        <form class="d-flex" method="GET">
            <input class="form-control" type="text" placeholder="Title" name="title" value="{{ request()->get('title') }}">
            <select class="form-select" aria-label="Default select example" id="category_id" name="category">
                <option value="" disabled selected>Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}"
                        {{ request()->input('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                    </option>
                @endforeach
            </select>
            <input class="form-control" type="text" placeholder="Author" name="author"
                value="{{ request()->get('author') }}">
            <button class="btn
                btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    @if (request()->get('tag'))
        <div class="container mt-3">
            <p class="display-4"><strong>Tag:</strong> #{{ request()->get('tag') }}</p>
        </div>
    @endif
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card m-3" style="width: 18rem;">
                    <img src="{{ Storage::url($post->thumb) }}" class="card-img-top" alt="...">
                    <div class="card-body mb-2">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <a href="{{ route('post.show', $post->slug) }}" class="card-link">Read</a>
                    </div>
                    <div class="blockquote-footer"> Author: {{ $post->author->name }}</div>
                    <div class="blockquote-footer"> {{ $post->likes->count() }} likes</div>
                    <div class="card-footer text-muted">
                        At {{ $post->published_at }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
@endsection
