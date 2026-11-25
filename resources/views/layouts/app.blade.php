<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Event Check-in') }}</title>
    <link rel="stylesheet" href="{{ secure_asset('app.css') }}">
</head>

<body>
    <header><a class="brand" href="{{ route('events.index') }}">✦ CheckIn Cebu</a>
        <nav><a href="{{ route('events.index') }}">Events</a><a href="{{ route('tickets.lookup') }}">Find ticket</a>
            @if (session('staff_user_id'))
                <a href="{{ route('staff.dashboard') }}">Staff</a>
            <form method="POST" action="{{ route('staff.logout') }}">@csrf<button>Sign out</button></form>@else<a
                    href="{{ route('staff.login') }}">Staff sign in</a>
            @endif
        </nav>
    </header>
    <main class="container">
        @if (session('success'))
            <div class="notice success">{{ session('success') }}</div>
            @endif @if (session('error'))
                <div class="notice danger">{{ session('error') }}</div>
            @endif @yield('content')
    </main>
</body>

</html>
