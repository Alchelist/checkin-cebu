<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#12382e">
    <title>@yield('title', 'Gather Cebu')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('studio.css') }}">
</head>

<body>
    <header class="site-header">
        <a class="wordmark" href="{{ route('events.index') }}"><span class="wordmark-mark">G</span><span>gather<span
                    class="wordmark-city">cebu</span></span></a>
        <nav class="site-nav" aria-label="Main navigation">
            <a href="{{ route('events.index') }}">Discover</a>
            <a href="{{ route('tickets.lookup') }}">My ticket</a>
            @if (session('staff_user_id'))
                <a href="{{ route('staff.dashboard') }}">Staff console</a>
                <form method="POST" action="{{ route('staff.logout') }}">@csrf<button class="nav-button">Sign
                        out</button></form>
            @else
                <a class="nav-staff" href="{{ route('staff.login') }}">Staff sign in</a>
            @endif
        </nav>
    </header>
    <main>
        @if (session('success'))
            <div class="flash flash-success"><span>Success</span>{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="flash flash-error"><span>Notice</span>{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer class="site-footer"><span>GATHER CEBU</span><span>Good people. Useful rooms.</span><span>Asia/Manila</span>
    </footer>
</body>

</html>
