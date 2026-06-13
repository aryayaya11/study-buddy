

@extends('layouts.app_admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <h2 class="text-4xl font-extrabold text-blue-900 mb-2">
                Selamat Datang, Admin! 👋
            </h2>
            <p class="text-lg text-slate-500 font-medium">Kelola sistem pembelajaran dengan mudah dan efisien.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <a href="{{ route('admin.students') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-3xl group-hover:grayscale-[100] group-hover:brightness-0 group-hover:invert transition-all">👨‍🎓</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Manajemen Siswa</h3>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola data siswa dan akun mereka dalam sistem.</p>
            </a>

            <a href="{{ route('admin.tutors') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-3xl group-hover:grayscale-[100] group-hover:brightness-0 group-hover:invert transition-all">👨‍🏫</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Manajemen Tutor</h3>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola profil tutor, kredensial, dan status aktif.</p>
            </a>

            <a href="{{ route('admin.classes') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-3xl group-hover:grayscale-[100] group-hover:brightness-0 group-hover:invert transition-all">📚</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Manajemen Kelas</h3>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Atur jadwal kelas, penugasan tutor, dan mapel.</p>
            </a>

            <a href="{{ route('admin.enrollments') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-3xl group-hover:grayscale-[100] group-hover:brightness-0 group-hover:invert transition-all">📝</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Manajemen Pendaftaran</h3>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Pantau status pendaftaran siswa dan pembayaran.</p>
            </a>

            <a href="{{ route('admin.admins') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-3xl group-hover:grayscale-[100] group-hover:brightness-0 group-hover:invert transition-all">⚙️</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Manajemen Admin</h3>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola hak akses dan akun administrator lainnya.</p>
            </a>

            <a href="{{ route('admin.statistics') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-3xl group-hover:grayscale-[100] group-hover:brightness-0 group-hover:invert transition-all">📊</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Statistik & DW</h3>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Lihat laporan analitik dan performa data warehouse.</p>
            </a>
        </div>

        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-lg text-white flex items-center justify-between">
            <div>
                <h4 class="text-xl font-bold mb-1 flex items-center gap-2">💡 Tip Administratif</h4>
                <p class="text-blue-100 text-sm">Pantau semua aktivitas sistem secara berkala untuk menjaga keandalan platform.</p>
            </div>
            <div class="text-5xl opacity-50">🚀</div>
        </div>
    </div>
@endsection
