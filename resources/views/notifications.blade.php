@extends('layouts.client-layout')
@section('content')
    <div class="container">
        <div class="card">
            <h1 class="card-header text-center">
                Notifications
            </h1>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($notifications as $notification)
                        <li class="list-group-item">
                            <div class="card m-2">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $notification->data['from'] }}</h6>
                                    <p class="card-text">{{ $notification->data['message'] }}</p>
                                </div>
                                <a href="/" class="stretched-link"></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
