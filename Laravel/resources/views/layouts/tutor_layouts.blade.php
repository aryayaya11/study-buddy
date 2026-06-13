<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Buddy - Tutor</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col hidden md:flex">
        <div class="p-6 border-b border-blue-800">
            <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight hover:text-blue-200 transition">STUDY BUDDY</a>
        </div>
        
        <div class="p-6">
            <p class="text-xs uppercase tracking-wider text-blue-300 font-semibold mb-2">Tutor Area</p>
            <p class="font-medium text-lg">{{ Auth::user()->nama }}</p>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <a href="{{ route('tutor.dashboard') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('tutor.dashboard')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Dashboard</a>
            <a href="{{ route('tutor.profile') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('tutor.profile')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Profil Saya</a>
            <a href="{{ route('tutor.classes') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('tutor.classes')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Daftar Kelas</a>
            <a href="{{ route('tutor.materials') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('tutor.materials')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Manajemen Materi</a>
        </nav>

        <div class="p-4 border-t border-blue-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition shadow-sm">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Header for Mobile & Quick Actions -->
        <header class="bg-white shadow-sm border-b border-slate-200 p-4 flex justify-between items-center md:justify-end">
            <div class="md:hidden text-xl font-bold text-blue-900">STUDY BUDDY</div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-slate-500">Tutor Panel</span>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto bg-slate-50">
            @yield('content')
        </main>
    </div>

</body>
</html>
