@extends('layouts.app')
@section('title', 'Materi')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📖 Materi Belajar</h2>
            <p class="text-slate-500 text-sm mt-1">Akses semua modul dan referensi belajar untuk kelas Anda.</p>
        </div>
    </div>

    @if($materi->isEmpty())
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 text-center">
            <div class="text-6xl mb-4 opacity-50">📭</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Materi</h3>
            <p class="text-slate-500">Materi pembelajaran untuk jenjang atau kelas Anda belum tersedia saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($materi as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full">
                    <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-100 flex items-center gap-4">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-indigo-600 text-xl">
                            📚
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-indigo-900 text-lg truncate">
                                {{ $item->mapel->nama_mapel ?? 'Mata Pelajaran' }}
                            </h3>
                            <p class="text-indigo-600 text-xs font-semibold uppercase tracking-wider">{{ $item->mapel->jenjang ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-slate-600 text-sm mb-6 flex-1">
                            Akses modul pembelajaran, tugas, dan referensi bacaan untuk mata pelajaran ini melalui tautan Google Drive di bawah.
                        </p>
                        
                        <a href="{{ $item->content_url }}" target="_blank" class="w-full py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Buka Google Drive
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
