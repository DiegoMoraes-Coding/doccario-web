<!DOCTYPE html>
<html lang="en">

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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    @yield('content')
</body>

</html>
