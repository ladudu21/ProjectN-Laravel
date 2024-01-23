@extends('admin.dashboard')
@section('title', 'Admins')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->implode('name', ', ') }}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.users.ad_edit', $user) }}" class="btn btn-info m-1">Edit</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
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
    {{ $users->links() }}
@endsection
