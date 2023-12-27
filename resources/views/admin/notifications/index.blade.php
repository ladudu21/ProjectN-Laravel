@extends('admin.dashboard')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Message_id</th>
                <th scope="col">Created by</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
                @php
                    $data = json_decode($notification->data, true);
                @endphp
                <tr>
                    <td>{{ $notification->message_id }}</td>
                    <td>{{ $data['from'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.notifications.edit', $notification->id) }}" class="btn btn-info m-1">Edit</a>
                        <form method="POST" action="{{ route('admin.notifications.destroy', $notification->message_id) }}"
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
@endsection
