@extends('admin.dashboard')
@section('title', 'Categories')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-info m-1">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
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
    {{ $categories->links() }}
@endsection
