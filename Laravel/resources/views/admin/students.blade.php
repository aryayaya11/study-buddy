@extends('layouts.app_admin')

@section('title', 'Manajemen Siswa')

@section('content')
<div class="bg-orange-300 p-8 rounded-lg min-h-[calc(100vh-10rem)]">
    <div class="grid grid-cols-6 gap-4 font-bold text-center border-b-2 border-dashed pb-2">
        <span>Nama Siswa</span>
        <span>Jenis Kelamin</span>
        <span>Jenjang</span>
        <span>Nomor Whatsapp</span>

    </div>

    @foreach($students as $student)
   <div class="grid grid-cols-6 gap-4 text-center py-2 border-b border-gray-400">
        <span>{{ $student->user?->nama ?? 'N/A' }}</span>
        <span>{{ $student->user?->jenis_kelamin ?? 'N/A' }}</span>
        <span>{{ $student->jenjang }}</span>
        <span>{{ $student->user?->no_whatsapp ?? 'N/A' }}</span>

    </div>
    @endforeach
</div>
@endsection