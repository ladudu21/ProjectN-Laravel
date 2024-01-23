@extends('layouts.client-layout')
@section('content')
    <div class="container">
        <div class="card">
            <h1 class="card-header text-center">
                {{ __('Notifications') }}
            </h1>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($notifications as $notification)
                        <li class="list-group-item">
                            <div class="card m-2 {{ $notification->read_at == null ? 'bg-light' : '' }}">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $notification->data['from'] }}</h6>
                                    <div class="text-muted small">{{ $notification->created_at }}</div>
                                    <p class="card-text">{{ $notification->data['message'] }}</p>
                                </div>
                                <a href="{{ route('notifications.read', $notification->id) }}" class="stretched-link"></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
