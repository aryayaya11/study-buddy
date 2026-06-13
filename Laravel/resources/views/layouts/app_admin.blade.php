<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col hidden md:flex">
        <div class="p-6 border-b border-blue-800">
            <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight hover:text-blue-200 transition">STUDY BUDDY</a>
        </div>
        
        <div class="p-6">
            <p class="text-xs uppercase tracking-wider text-blue-300 font-semibold mb-2">Admin Area</p>
            <p class="font-medium text-lg">{{ Auth::user()->nama }}</p>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('admin.dashboard')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Dashboard</a>
            <a href="{{ route('admin.students') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('admin.students')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Manajemen Siswa</a>
            <a href="{{ route('admin.classes') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('admin.classes')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Manajemen Kelas</a>
            <a href="{{ route('admin.enrollments') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('admin.enrollments')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Manajemen Pendaftaran</a>
            <a href="{{ route('admin.tutors') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('admin.tutors')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Manajemen Tutor</a>
            <a href="{{ route('admin.admins') }}" class="block px-4 py-2.5 rounded-lg transition @if(request()->routeIs('admin.admins')) bg-blue-800 text-white font-semibold @else text-blue-100 hover:bg-blue-800 hover:text-white @endif">Manajemen Admin</a>
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
                <span class="text-sm text-slate-500">Administrator Panel</span>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto bg-slate-50">
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
