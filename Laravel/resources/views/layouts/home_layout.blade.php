<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Study Buddy</title>

  @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 text-slate-800">
  <header class="bg-blue-800 shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tight">
            <a href="{{ route('home') }}" class="text-white hover:text-blue-200 transition">STUDY BUDDY</a>
        </div>
        <nav class="hidden md:flex space-x-8">
            <a href="{{ url('/') }}" class="text-blue-50 font-medium hover:text-white transition">Home</a>
            <a href="{{ url('/tentang-kami') }}" class="text-blue-50 font-medium hover:text-white transition">Tentang Kami</a>
            <a href="{{ url('/biaya') }}" class="text-blue-50 font-medium hover:text-white transition">Biaya & Pendaftaran</a>
            <a href="{{ url('/contact') }}" class="text-blue-50 font-medium hover:text-white transition">Contact</a>
        </nav>

        <div>
            <a href="{{ url('/login') }}" class="bg-yellow-400 text-blue-900 font-semibold px-6 py-2 rounded-full hover:bg-yellow-300 transition shadow-sm">Login</a>
        </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>
