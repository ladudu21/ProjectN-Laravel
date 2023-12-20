<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.3.2/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-H8oVKJOQVGGCdfFNM+9gLKN0xagtq9oiNLirmijheEuqD3kItTbTvoOGgxVKqNiB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.3.2/dist/js/coreui.bundle.min.js"
        integrity="sha384-yaqfDd6oGMfSWamMxEH/evLG9NWG7Q5GHtcIfz8Zg1mVyx2JJ/IRPrA28UOLwAhi" crossorigin="anonymous">
    </script>
</head>

<body>
    <h1>Admin Page</h1>
    <div class="d-flex justify-content-start">
        <div class="dropdown p-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                aria-expanded="false">
                Users
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Index</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.users.create') }}">Add</a></li>
            </ul>
        </div>
        <div class="dropdown p-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                aria-expanded="false">
                Posts
            </button>
            <ul class="dropdown-menu p-3">
                <li><a class="dropdown-item" href="#">Index</a></li>
                <li><a class="dropdown-item" href="#">Add</a></li>
            </ul>
        </div>
        <div class="dropdown p-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                aria-expanded="false">
                Categories
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Index</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.categories.create') }}">Add</a></li>
            </ul>
        </div>
        <div class="dropdown p-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                aria-expanded="false">
                Notifications
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Index</a></li>
                <li><a class="dropdown-item" href="#">Add</a></li>
            </ul>
        </div>
    </div>

    @if ($message = Session::get('message'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>

</html>
