@extends('layouts.app_admin')
@section('title', 'Manajemen Pendaftaran & Pembayaran')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📄 Manajemen Pendaftaran & Pembayaran</h2>
            <p class="text-slate-500 text-sm mt-1">Verifikasi pembayaran siswa dan pantau status pendaftaran kelas.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">Program</th>
                        <th class="px-6 py-4 text-right">Nominal</th>
                        <th class="px-6 py-4 text-center">Metode</th>
                        <th class="px-6 py-4 text-center">Bukti Transfer</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($transaksi as $t)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $t->pendaftaran->siswa->nama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="block text-slate-800 font-medium">{{ $t->pendaftaran->kelas->mapel->nama_mapel ?? '-' }}</span>
                            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded uppercase border border-blue-100 mt-1 inline-block">{{ $t->pendaftaran->kelas->jenjang ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-slate-700">Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center capitalize text-slate-600 text-sm font-medium">{{ $t->metode_bayar }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($t->bukti_bayar)
                                <a href="{{ asset('storage/' . $t->bukti_bayar) }}" target="_blank" class="inline-block hover:opacity-80 transition-opacity rounded shadow-sm border border-slate-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $t->bukti_bayar) }}" class="w-14 h-14 object-cover" alt="Bukti">
                                </a>
                            @else
                                <span class="text-slate-400 text-sm italic">Kosong</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($t->status_bayar === 'paid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Berhasil</span>
                            @elseif ($t->status_bayar === 'failed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Gagal</span>
                            @elseif ($t->status_bayar === 'menunggu_verifikasi')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">Cek Bukti</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.enrollments.update', $t->transaksi_id) }}" class="flex items-center justify-center gap-2">
                                @csrf
                                <select name="status_bayar" class="bg-white border border-slate-300 text-slate-700 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 shadow-sm w-36">
                                    <option value="paid" {{ $t->status_bayar == 'paid' ? 'selected' : '' }}>Berhasil</option>
                                    <option value="failed" {{ $t->status_bayar == 'failed' ? 'selected' : '' }}>Gagal</option>
                                    <option value="menunggu_verifikasi" {{ $t->status_bayar == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                    <option value="pending" {{ $t->status_bayar == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-lg shadow-sm transition-colors" title="Simpan Status">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center">
                            <div class="text-slate-400 text-4xl mb-2">💸</div>
                            <p class="text-slate-500 font-medium">Belum ada transaksi pembayaran yang masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
