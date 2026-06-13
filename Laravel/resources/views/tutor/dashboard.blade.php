@extends('layouts.tutor_layouts')
@section('title', 'Tutor Dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-10 text-center sm:text-left flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="text-3xl font-extrabold text-blue-900 mb-2">
                Halo, {{ Auth::user()->nama }}! 👋
            </h2>
            <p class="text-slate-500 font-medium text-lg">Semoga harimu menyenangkan. Apa yang ingin kamu lakukan hari ini?</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('tutor.classes') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 block relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="bg-blue-100 text-blue-600 w-14 h-14 rounded-xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition-colors">Lihat Kelas</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola siswa dan pantau kelas yang Anda ajar saat ini.</p>
            </div>
        </a>

        <a href="{{ route('tutor.materials') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 block relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="bg-indigo-100 text-indigo-600 w-14 h-14 rounded-xl flex items-center justify-center mb-5 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-indigo-600 transition-colors">Materi Belajar</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Unggah dan bagikan materi pembelajaran kepada siswa.</p>
            </div>
        </a>

        <a href="{{ route('tutor.profile') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 block relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-teal-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="bg-teal-100 text-teal-600 w-14 h-14 rounded-xl flex items-center justify-center mb-5 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-teal-600 transition-colors">Profil Saya</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Perbarui informasi pribadi dan atur kata sandi Anda.</p>
            </div>
        </a>
    </div>

    <div class="mt-12">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 rounded-2xl shadow-md text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="text-5xl">💡</div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Tip Hari Ini</h4>
                    <p class="text-blue-100 text-lg leading-relaxed">Jaga interaksi dengan siswa secara aktif! Membalas pertanyaan dengan cepat dan memberikan umpan balik konstruktif dapat meningkatkan hasil belajar yang optimal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
