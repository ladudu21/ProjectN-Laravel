@extends('layouts.client-layout')
@section('content')
    <div class="container">
        <div class="card border-dark m-3">
            <div class="card-header">
                <h1>{{ $post->title }}</h1>
                <h6 class="card-subtitle text-muted mb-1">Writer: {{ $post->user->name }}</h6>
                <div class="card-subtitle text-muted">posted at {{ $post->published_at }}</div>
                @if ($post->published_at != $post->updated_at)
                    <div class="card-subtitle text-muted">updated at {{ $post->updated_at }}</div>
                @endif
            </div>

            <div class="card-body text-dark">
                <p class="card-text">{!! $post->content !!}</p>
                @foreach ($post->tags as $tag)
                    <a class="btn btn-outline-primary btn-sm"
                        href="{{ route('homepage', ['tag' => $tag->name]) }}">#{{ $tag->name }}</a>
                @endforeach
            </div>
            <div class="card-footer d-flex">
                @auth
                    @if ($post->likes->contains('user_id', Auth::user()->id))
                        <button class="btn btn-block btn-primary like">
                            <span class="numl">{{ $post->likes->count() }}</span>
                            <i class="fa-solid fa-thumbs-up"></i>
                        </button>
                    @else
                        <button class="btn btn-block btn-secondary like">
                            <span class="numl">{{ $post->likes->count() }}</span>
                            <i class="fa-solid fa-thumbs-up"></i>
                        </button>
                    @endif
                @endauth
                @guest
                    <button class="btn btn-block btn-secondary like">
                        <span class="numl">{{ $post->likes->count() }}</span>
                        <i class="fa-solid fa-thumbs-up"></i>
                    </button>
                @endguest
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <form class="form-outline mb-4" action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <label class="form-label" for="comment">Comments<span
                                class="text-muted"> - {{ $post->comments->count() }}</span> </label>
                        <input type="text" id="content" name="content" class="form-control"
                            placeholder="Type comment..." />
                        @error('content')
                            <div class="alert alert-danger">{{ $message }};</div>
                        @enderror
                        <input type="submit" hidden />
                    </form>

                    @foreach ($post->comments as $comment)
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-2 text-muted">{{ $comment->user->name }}</p>
                                <p class="blockquote-footer">{{ $comment->created_at }}</p>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @auth
        <script>
            $(".like").on("click", function() {

                $.ajax({
                    url: '{{ route('likes.store', $post) }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        post_id: {{ $post->id }},
                    },
                    success: function(rs) {
                        if (rs.message == 'like') {
                            $(".like").removeClass('btn-secondary').addClass('btn-primary');
                            $(".numl").html(parseInt($(".numl").html(), 10) + 1);
                        } else {
                            $(".like").removeClass('btn-primary').addClass('btn-secondary');
                            $(".numl").html(parseInt($(".numl").html(), 10) - 1);
                        }
                    },
                });
            });
        </script>
    @endauth
    @guest
        <script>
            $(".like").on("click", function() {
                alert('You Need To Login First');
            });

            $('#content').keypress(function(e) {
                alert('You Need To Login First');
                e.preventDefault();
            });
        </script>
    @endguest
@endsection
