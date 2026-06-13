@extends('layouts.home_layout')

@section('content')
<div class="min-h-screen bg-slate-50 py-16 flex items-center justify-center">
    <div class="bg-white p-8 md:p-12 rounded-2xl shadow-xl w-full max-w-2xl border border-slate-100">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-blue-900 tracking-tight">Daftar Akun Baru</h2>
            <p class="text-slate-500 mt-2">Bergabunglah dengan Study Buddy dan raih prestasimu</p>
        </div>

        <form action="{{ route('daftar.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white appearance-none">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- WhatsApp -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nomor WhatsApp Aktif</label>
                    <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp') }}" required 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white">
                    @error('no_whatsapp')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white">
                    @error('tanggal_lahir')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jenjang -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jenjang Pendidikan</label>
                    <select name="jenjang" required 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white appearance-none">
                        <option value="">-- Pilih Jenjang --</option>
                        <optgroup label="SD">
                            <option value="SD1">SD 1</option><option value="SD2">SD 2</option>
                            <option value="SD3">SD 3</option><option value="SD4">SD 4</option>
                            <option value="SD5">SD 5</option><option value="SD6">SD 6</option>
                        </optgroup>
                        <optgroup label="SMP">
                            <option value="SMP1">SMP 1</option><option value="SMP2">SMP 2</option><option value="SMP3">SMP 3</option>
                        </optgroup>
                        <optgroup label="SMA">
                            <option value="SMA1">SMA 1</option><option value="SMA2">SMA 2</option><option value="SMA3">SMA 3</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password (min. 6 karakter)</label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 px-4 rounded-xl hover:bg-blue-700 hover:shadow-lg transition-all duration-300">
                    Daftar Sekarang!
                </button>
            </div>
            
            <p class="text-center text-sm text-slate-500 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection