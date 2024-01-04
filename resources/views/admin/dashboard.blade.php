<!DOCTYPE html><!--
    * CoreUI - Free Bootstrap Admin Template
    * @version v4.2.2
    * @link https://coreui.io/product/free-bootstrap-admin-template/
    * Copyright (c) 2023 creativeLabs Łukasz Holeczek
    * Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
    --><!-- Breadcrumb-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin</title>
    <!-- /template/vendors styles-->
    <link rel="stylesheet" href="/template/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="/template/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="/template/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="/template/css/examples.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="/template/assets/brand/coreui.svg#full"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="/template/assets/brand/coreui.svg#signet"></use>
            </svg>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <svg class="nav-icon">
                        <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                    </svg> Dashboard</a></li>
            <li class="nav-title">Manage</li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                    </svg> User</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}"><span
                                class="nav-icon"></span>
                            Index</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.create') }}"><span
                                class="nav-icon"></span>
                            Add user</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                    </svg> Category</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><span
                                class="nav-icon"></span>
                            Index</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.create') }}"><span
                                class="nav-icon"></span>
                            Add category</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                    </svg> Post</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts.index') }}"><span
                                class="nav-icon"></span>
                            Index</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts.create') }}"><span
                                class="nav-icon"></span>
                            Add post</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg> Notifications</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.notifications.index') }}"><span
                                class="nav-icon"></span>
                            Index</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.notifications.create') }}"><span
                                class="nav-icon"></span>
                            Send notification</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="/template/assets/brand/coreui.svg#full"></use>
                    </svg></a>
                <ul class="header-nav d-none d-md-flex">
                    <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Client</a></li>
                </ul>
                <ul class="header-nav ms-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                                aria-expanded="false" id="noti-button">
                                <i class="fa-solid fa-bell"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <a class="m-2" href="{{ route('notifications.list') }}">All notifications</a>
                                <li id="newNoti"></li>
                                @foreach ($notifications as $notification)
                                    <li>
                                        <div class="card m-2" style="width: 30rem;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $notification->data['from'] }}</h6>
                                                <p class="card-text">{{ $notification->data['message'] }}</p>
                                            </div>
                                            <a href="{{ route('notifications.read', $notification->id) }}"
                                                class="stretched-link"></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div>
                                <strong>{{ Auth::user()->name }}</strong>
                                <i class="fa-solid fa-circle-chevron-down"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Settings</div>
                            </div><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg> Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    <svg class="icon me-2">
                                        <use
                                            xlink:href="/template/vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                                        </use>
                                    </svg> Logout</a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header-divider"></div>
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <!-- if breadcrumb is single--><span>Dashboard</span>
                        </li>
                        <li class="breadcrumb-item active"><span>@yield('title')</span></li>
                    </ol>
                </nav>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container">
                @if ($message = Session::get('message'))
                    <div class="container">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <p>{{ __($message) }}</p>
                            <button type="button" class="btn-close" data-coreui-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="footer">
            <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> ©
                2023 creativeLabs.</div>
            <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
        </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="/template/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="/template/vendors/simplebar/js/simplebar.min.js"></script>
    <script></script>

</body>

</html>
