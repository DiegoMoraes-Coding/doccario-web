<!DOCTYPE html>
<html lang="en" class="h-100 w-100">

<head>
    <script>
        (function() {
            var theme = localStorage.getItem('theme');
            if (!theme) theme = 'dark';
            document.documentElement.classList.toggle('theme-dark', theme === 'dark');
            document.documentElement.setAttribute('data-bs-theme', theme === 'dark' ? 'dark' : 'light');
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Doccario')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="h-100 w-100 d-flex flex-column overflow-x-hidden">
    @include('components.notifications')
    @if (!request()->routeIs('login') && !request()->routeIs('signup'))
        @include('components.header')
    @endif
    <div class="flex-grow-1 d-flex flex-column">
        @yield('content')
    </div>
    @include('components.confirm-modal')
</body>

</html>
