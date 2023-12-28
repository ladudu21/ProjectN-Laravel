<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.3.2/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-H8oVKJOQVGGCdfFNM+9gLKN0xagtq9oiNLirmijheEuqD3kItTbTvoOGgxVKqNiB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.3.2/dist/js/coreui.bundle.min.js"
        integrity="sha384-yaqfDd6oGMfSWamMxEH/evLG9NWG7Q5GHtcIfz8Zg1mVyx2JJ/IRPrA28UOLwAhi" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite('resources/js/app.js')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{ __('Home') }}</a>
            <button class="navbar-toggler" type="button" data-coreui-toggle="collapse"
                data-coreui-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (Route::has('login'))
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @endauth
                        @role('admin')
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('admin.dashboard') }}">Admin</a>
                            </li>
                        @endrole
                        @role('writer')
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('writer.dashboard') }}">Writer</a>
                            </li>
                        @endrole
                        @auth
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                                        aria-expanded="false" id="noti-button">
                                        <i class="fa-solid fa-bell"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <a class="m-2" href="{{ route('notifications.show') }}">All notifications</a>
                                        <li id="newNoti"></li>
                                        @foreach ($notifications as $notification)
                                            <li>
                                                <div class="card m-2" style="width: 30rem;">
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
                            </li>
                        @endauth
                    </ul>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            <a class="text-reset" href="{!! route('change-language', ['en']) !!}">English</a>
            <a class="text-reset" href="{!! route('change-language', ['vi']) !!}">Vietnam</a>
        </div>
    </footer>
</body>
@auth
    <script type="module">
        var userId = {{ Auth::user()->id }};
        var channel = Echo.private('App.Models.User.' + userId)
            .notification((notification) => {
                var html =
                    '<div class="card bg-light m-2" style="width: 30rem;"><div class="card-body"><h6 class="card-title">' +
                    notification.from + '</h6><p class="card-text">' + notification.message +
                    '</p></div><a href="/" class="stretched-link"></a></div>';

                $('#newNoti').append(html);
                $('#noti-button').addClass('btn-danger');
            });
    </script>
@endauth
<style>
    .dropdown-menu {
        max-height: 400px;
        overflow-y: auto;
    }
</style>

</html>
