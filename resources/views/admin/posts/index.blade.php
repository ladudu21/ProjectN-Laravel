@extends('admin.dashboard')
@section('title', 'Posts')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Publish</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->author->name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->published_at }}</td>
                    <td>{{ $post->status ? 'Released' : 'Unreleased' }}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info m-1">Edit</a>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                            onsubmit="return confirm('Delete ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger m-1" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection
