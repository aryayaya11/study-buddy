@extends('layouts.app_admin')
@section('title', 'Manajemen Kelas')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between md:items-end mb-8 gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📘 Manajemen Kelas</h2>
            <p class="text-slate-500 text-sm mt-1">Atur pembagian kelas dan tugaskan tutor ke kelas yang aktif.</p>
        </div>

        {{-- 🔽 Filter Form --}}
        <form method="GET" action="{{ route('admin.classes') }}" class="flex flex-wrap items-end gap-3">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Jenjang</label>
                <select id="jenjang" name="jenjang" class="bg-white border border-slate-300 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 shadow-sm transition">
                    <option value="">Semua</option>
                    @foreach ($jenjangList as $jenjang)
                        <option value="{{ $jenjang }}" {{ $filterJenjang == $jenjang ? 'selected' : '' }}>
                            {{ strtoupper($jenjang) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Mata Pelajaran</label>
                <select id="mapel" name="mapel_id" class="bg-white border border-slate-300 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-48 p-2.5 shadow-sm transition" disabled>
                    <option value="">Pilih Jenjang Dulu</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-sm transition flex items-center gap-2 h-[42px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter
            </button>
        </form>
    </div>

    {{-- 🔽 Daftar Kelas --}}
    @if(count($kelasList) === 0)
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 text-center">
            <div class="text-6xl mb-4 opacity-50">📭</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Kelas</h3>
            <p class="text-slate-500">Tidak ada kelas aktif yang sesuai dengan filter.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach ($kelasList as $kelas)
            <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-blue-900 flex items-center gap-2">
                            <span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded border border-blue-200 uppercase">{{ $kelas->jenjang }}</span>
                            {{ $kelas->mapel->nama_mapel }}
                        </h3>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-slate-500 block">Harga Program</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($kelas->harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                <th class="px-6 py-3 w-32">Kelas ID</th>
                                <th class="px-6 py-3 w-48">Siswa ID</th>
                                <th class="px-6 py-3">Penugasan Tutor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($kelas->pendaftaran as $p)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-600">#{{ $p->kelas_id }}</td>
                                    <td class="px-6 py-4 text-slate-800">{{ $p->siswa_id }}</td>
                                    <td class="px-6 py-4">
                                        @if($p->tutor_assignment)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-green-50 text-green-700 font-medium text-sm border border-green-200">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Tutor ID: {{ $p->tutor_assignment->tutor_id }}
                                            </span>
                                        @else
                                            <form action="{{ route('admin.classes.assignTutor') }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                <input type="hidden" name="kelas_id" value="{{ $p->kelas_id }}">
                                                <input type="hidden" name="siswa_id" value="{{ $p->siswa_id }}">

                                                @php
                                                    $tutors = \App\Models\Tutor::where('mapel_id', $kelas->mapel_id)->get();
                                                @endphp

                                                <select name="tutor_id" class="bg-white border border-slate-300 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 shadow-sm transition" required>
                                                    <option value="">Pilih Tutor</option>
                                                    @foreach ($tutors as $tutor)
                                                        <option value="{{ $tutor->tutor_id }}">{{ $tutor->tutor_id }}</option>
                                                    @endforeach
                                                </select>

                                                <button type="submit" class="bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 shadow-sm transition-colors text-sm font-medium">
                                                    Tugaskan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-slate-500 italic">
                                        Belum ada siswa yang pembayarannya berhasil di kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- ✅ Script AJAX untuk filter mapel berdasarkan jenjang --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenjangSelect = document.getElementById('jenjang');
    const mapelSelect = document.getElementById('mapel');

    function fetchMapel(jenjang) {
        if (!jenjang) {
            mapelSelect.innerHTML = '<option value="">Pilih Jenjang Dulu</option>';
            mapelSelect.disabled = true;
            return;
        }

        mapelSelect.innerHTML = '<option value="">Memuat...</option>';
        mapelSelect.disabled = true;

        fetch(`/admin/classes/get-mapel?jenjang=${jenjang}`)
            .then(response => response.json())
            .then(data => {
                mapelSelect.innerHTML = '<option value="">Semua</option>';
                data.forEach(mapel => {
                    const opt = document.createElement('option');
                    opt.value = mapel.mapel_id;
                    opt.textContent = mapel.nama_mapel;
                    mapelSelect.appendChild(opt);
                });
                mapelSelect.disabled = false;
            })
            .catch(err => {
                console.error('Gagal memuat mapel:', err);
                mapelSelect.innerHTML = '<option value="">Gagal memuat mapel</option>';
            });
    }

    jenjangSelect.addEventListener('change', function () {
        fetchMapel(this.value);
    });

    // Auto-fetch jika ada value awal
    if(jenjangSelect.value) {
        fetchMapel(jenjangSelect.value);
    }
});
</script>
@endsection
