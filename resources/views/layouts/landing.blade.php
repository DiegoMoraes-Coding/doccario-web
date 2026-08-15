<!DOCTYPE html>
<html lang="en" class="h-100">

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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Doccario — AI-Powered Document Workspace')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="d-flex flex-column min-vh-100 overflow-x-hidden" data-warm-api="true">
    @include('components.api-wakeup-overlay')
    @include('components.notifications')
    @yield('content')
</body>

</html>
