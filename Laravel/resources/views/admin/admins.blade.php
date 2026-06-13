@extends('layouts.app_admin')

@section('title', 'Manajemen Admin')

@section('content')
<div class="bg-orange-300 p-8 rounded-lg min-h-[calc(100vh-10rem)]">
    <div class="grid grid-cols-4 gap-4 font-bold text-center border-b-2 border-dashed pb-2">
        <span>ID Admin</span>
        <span>Nama Admin</span>
        <span>Jenis Kelamin</span>
        <span>Nomor Whatsapp</span>
    </div>

    @foreach($admins as $admin)
    <div class="grid grid-cols-4 gap-4 text-center py-2 border-b border-gray-400">
        <span>{{ $admin->user_id }}</span>
        <span>{{ $admin->nama }}</span>
        <span>{{ $admin->jenis_kelamin }}</span>
        <span>{{ $admin->no_whatsapp }}</span>
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