<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tugas Mas Ivan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* ini kunci biar user-info turun ke bawah */
            position: fixed;
            padding-top: 20px;
        }

        .sidebar a {
            color: #adb5bd;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
            color: white;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link:hover {
            color: white;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar-header {
            padding: 0 15px 20px 15px;
            border-bottom: 1px solid #495057;
            margin-bottom: 15px;
        }

        .user-info {
            padding: 15px;
            border-top: 1px solid #495057;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <div class="sidebar-header">
                <h4 class="text-white">Tugas Mas Ivan</h4>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                    </li>

                    @if(auth()->user()->role === 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                @endauth
            </ul>
        </div>

        @auth
            <div class="user-info">
                <p class="mb-1">{{ Auth::user()->name }}</p>
                <small class="text-light">{{ Auth::user()->email }}</small>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light w-100">Logout</button>
                </form>
            </div>
        @else
            <div class="user-info">
                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 mb-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary w-100">Register</a>
            </div>
        @endauth
    </div>

    <div class="main-content">


        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
