<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Study Buddy - Auth')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <main class="w-full max-w-md">
        @yield('content')
    </main>

</body>
</html>