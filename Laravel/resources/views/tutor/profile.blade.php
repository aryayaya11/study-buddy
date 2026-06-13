@extends('layouts.tutor_layouts')
@section('title', 'Profil Tutor')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">👤 Profil Saya</h2>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi pribadi dan kelola akun Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-600 relative">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        </div>
        
        <div class="px-8 pb-8">
            <div class="flex flex-col md:flex-row gap-6 items-start md:items-end -mt-12 mb-8">
                <div class="relative">
                    <div class="w-24 h-24 bg-white rounded-2xl p-1 shadow-md">
                        <div class="w-full h-full bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-3xl font-bold">
                            {{ strtoupper(substr($user->nama, 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div class="flex-1 pb-1">
                    <h3 class="text-2xl font-bold text-slate-800">{{ $user->nama }}</h3>
                    <p class="text-slate-500">{{ $user->email }} • <span class="text-blue-600 font-medium">Tutor Aktif</span></p>
                </div>
            </div>

            <form action="{{ route('tutor.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_lengkap" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama_lengkap" value="{{ old('nama', $user->nama) }}" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition">
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition">
                            <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label for="nomor_whatsapp" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Nomor WhatsApp</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" name="no_whatsapp" id="nomor_whatsapp" value="{{ old('no_whatsapp', $user->no_whatsapp) }}" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 pl-10 transition">
                        </div>
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition">
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-6 py-2.5 shadow-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('tutor.dashboard') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
