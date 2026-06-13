@extends('layouts.app_auth')

@section('title', 'Study Buddy - Login')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="h-2 w-full bg-gradient-to-r from-blue-500 to-blue-700"></div>
    <div class="p-8 md:p-10">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
                <span class="text-4xl">🎓</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800">Selamat Datang</h1>
            <p class="text-slate-500 mt-2">Masuk ke akun Study Buddy Anda</p>
        </div>

        <div class="flex justify-center gap-3 mb-8">
            <button type="button" class="role-btn px-5 py-2 rounded-full font-semibold text-sm border-2 border-slate-200 text-slate-500 hover:border-blue-500 hover:text-blue-500 transition-all duration-300" onclick="setRole('tutor')" id="btn-tutor">Tutor</button>
            <button type="button" class="role-btn px-5 py-2 rounded-full font-semibold text-sm border-2 border-blue-500 bg-blue-500 text-white shadow-md shadow-blue-500/30 transition-all duration-300" onclick="setRole('siswa')" id="btn-siswa">Siswa</button>
            <button type="button" class="role-btn px-5 py-2 rounded-full font-semibold text-sm border-2 border-slate-200 text-slate-500 hover:border-blue-500 hover:text-blue-500 transition-all duration-300" onclick="setRole('admin')" id="btn-admin">Admin</button>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 border border-red-100 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 border border-red-100 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="role" id="role" value="siswa">

            <div>
                <input type="text" name="username" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-slate-700 placeholder-slate-400" placeholder="Username" required>
            </div>

            <div>
                <input type="password" name="password" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-slate-700 placeholder-slate-400" placeholder="Password" required>
            </div>

            <div class="bg-slate-50 p-4 rounded-xl border border-dashed border-slate-300 text-xs text-slate-600 space-y-2">
                <p class="font-semibold text-slate-800">🔑 Akun Demo (Username / Password):</p>
                <ul class="space-y-1">
                    <li><span class="font-bold">Siswa:</span> abc@gmail.com / password</li>
                    <li><span class="font-bold">Tutor:</span> abcde@gmail.com / password</li>
                    <li><span class="font-bold">Admin:</span> abcdefg@gmail.com / password</li>
                </ul>
                <p class="text-[11px] text-slate-400 italic pt-1">*Pastikan tombol Role di atas sudah diklik sesuai dengan akun.</p>
            </div>

            <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-bold text-lg shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all duration-300">
                Masuk ke Akun
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-600 font-medium transition-colors text-sm">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</div>

<script>
    function setRole(role) {
        document.getElementById("role").value = role;

        // Reset all buttons to inactive state
        const buttons = document.querySelectorAll('.role-btn');
        const inactiveClasses = ['border-slate-200', 'text-slate-500', 'bg-transparent', 'hover:border-blue-500', 'hover:text-blue-500'];
        const activeClasses = ['border-blue-500', 'bg-blue-500', 'text-white', 'shadow-md', 'shadow-blue-500/30'];

        buttons.forEach(btn => {
            btn.classList.remove(...activeClasses);
            btn.classList.add(...inactiveClasses);
        });

        // Activate selected button
        const activeBtn = document.getElementById("btn-" + role);
        activeBtn.classList.remove(...inactiveClasses);
        activeBtn.classList.add(...activeClasses);
    }
</script>
@endsection
