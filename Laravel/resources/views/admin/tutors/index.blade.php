@extends('layouts.app_admin')
@section('title', 'Manajemen Tutor')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">👨‍🏫 Manajemen Tutor</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola data tutor dan tambahkan akun tutor baru ke sistem.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- 🔹 Form Tambah Tutor --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-5 border-b border-slate-100 pb-2">➕ Tambah Tutor Baru</h3>
        <form method="POST" action="{{ route('admin.tutors.store') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                <input type="text" name="nama_tutor" placeholder="Budi Santoso" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Email</label>
                <input type="email" name="email" placeholder="budi@example.com" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Mata Pelajaran</label>
                <select name="mapel_id" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->mapel_id }}">
                            {{ $mapel->nama_mapel }} ({{ strtoupper($mapel->jenjang) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-sm transition">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

    {{-- 🔹 Tabel Tutor --}}
    <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
        <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
            <h3 class="font-bold text-slate-800">Daftar Tutor Aktif ({{ $tutors->count() }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">Tutor ID</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tutors as $tutor)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-slate-600 font-medium">#{{ $tutor->tutor_id }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $tutor->user->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $tutor->user->email ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="block text-slate-800">{{ $tutor->mapel->nama_mapel ?? '-' }}</span>
                            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded uppercase border border-blue-100 mt-1 inline-block">{{ $tutor->mapel->jenjang ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form method="POST" action="{{ route('admin.tutors.destroy', $tutor->tutor_id) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium border border-red-200" onclick="return confirm('Peringatan: Yakin ingin menghapus akun tutor ini secara permanen?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">
                            <div class="text-5xl mb-3 opacity-50">👨‍🏫</div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Tutor</h3>
                            <p class="text-slate-500 text-sm">Gunakan form di atas untuk mendaftarkan tutor baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
