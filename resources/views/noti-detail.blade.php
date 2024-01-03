@extends('layouts.client-layout')
@section('content')
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">From: {{ $notification->data['from'] }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary small">{{ $notification->created_at }}</h6>
            <p class="card-text">{{ $notification->data['message'] }}</p>
        </div>
    </div>
@endsection
