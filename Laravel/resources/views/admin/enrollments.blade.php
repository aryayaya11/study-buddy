@extends('layouts.app_admin')

@section('title', 'Manajemen Pendaftaran')

@section('content')
<div class="bg-orange-300 p-8 rounded-lg min-h-[calc(100vh-10rem)]">
    <div class="grid grid-cols-8 gap-4 font-bold text-center border-b-2 border-dashed pb-2 text-sm">
        <span>ID Pendaftaran</span>
        <span>Nama Siswa</span>
        <span>Jenjang</span>
        <span>Mata Pelajaran</span>
        <span>Periode</span>
        <span>Sesi</span>
        <span>Harga Total</span>
        <span>Status Pembayaran</span>
    </div>

    @foreach($enrollments as $enrollment)
    <div class="grid grid-cols-8 gap-4 text-center py-2 border-b border-gray-400 text-sm">
        <span>{{ $enrollment->pendaftaran_id }}</span>
        <span>{{ $enrollment->siswa->user?->nama ?? 'N/A' }}</span>
        <span>{{ $enrollment->siswa?->jenjang ?? 'N/A' }}</span>
        <span>{{ $enrollment->mapel?->nama_mapel ?? 'N/A' }}</span>
        <span>{{ $enrollment->durasi }} bulan</span>
        <span>{{ $enrollment->sesi ?? 'N/A' }}</span>
        <span>{{ $enrollment->transaksi?->jumlah ?? 'N/A' }}</span>
        <span>{{ $enrollment->transaksi?->status_bayar ?? 'N/A' }}</span>
        <div class="flex justify-center">
            <button class="bg-blue-500 text-white px-4 py-1 rounded text-xs">edit</button>
        </div>
    </div>
    @endforeach
</div>
@endsection