@extends('layouts.app_admin')

@section('title', 'Manajemen Tutor')

@section('content')
<div class="bg-orange-300 p-8 rounded-lg min-h-[calc(100vh-10rem)]">
    <div class="grid grid-cols-6 gap-4 font-bold text-center border-b-2 border-dashed pb-2">
        <span>ID Tutor</span>
        <span>Nama Tutor</span>
        <span>Jenis Kelamin</span>
        <span>Nomor Whatsapp</span>
        <span>Pengalaman</span>
        <span>Rating</span>
        <span>Status</span>
    </div>

    @foreach($tutors as $tutor)
    <div class="grid grid-cols-6 gap-4 text-center py-2 border-b border-gray-400">
        <span>{{ $tutor->tutor_id }}</span>
        <span>{{ $tutor->user?->nama ?? 'N/A'}}</span>
        <span>{{ $tutor->user?->jenis_kelamin ?? 'N/A'}}</span>
        <span>{{ $tutor->user?->no_whatsapp ?? 'N/A'}}</span>
        <span>{{ $tutor->pengalaman }}</span>
        <span>{{ $tutor->rating }}</span>
        <span>{{ $tutor->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
        <div class="flex justify-center space-x-2">
            <button class="bg-red-500 text-white px-4 py-1 rounded">hapus</button>
            <button class="bg-blue-500 text-white px-4 py-1 rounded">edit</button>
        </div>
    </div>
    @endforeach
    
    <div class="text-center mt-8">
        <button class="bg-orange-400 text-white px-6 py-2 rounded-lg font-bold">+ TAMBAH DATA</button>
    </div>
</div>
@endsection