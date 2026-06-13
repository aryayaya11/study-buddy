@extends('layouts.tutor_layouts')
@section('title', 'Materi Pembelajaran')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📚 Materi Pembelajaran</h2>
            <p class="text-slate-500 text-sm mt-1">Akses tautan kelas Zoom dan referensi belajar untuk mata pelajaran Anda.</p>
        </div>
    </div>

    @if($materi)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
            <div class="bg-indigo-50 px-6 py-5 border-b border-indigo-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-indigo-600 text-2xl">
                    📖
                </div>
                <div>
                    <h3 class="text-xl font-bold text-indigo-900">{{ $materi->mapel->nama_mapel ?? 'Mata Pelajaran' }}</h3>
                    <p class="text-indigo-600 text-sm font-medium uppercase tracking-wider">{{ $materi->mapel->jenjang ?? '-' }}</p>
                </div>
            </div>
            
            <div class="p-6">
                <p class="text-slate-600 mb-6 leading-relaxed">
                    Tautan di bawah ini adalah akses resmi menuju materi pembelajaran dan ruang kelas interaktif (Zoom/Meet). Silakan gunakan tautan ini saat waktu kelas telah tiba.
                </p>
                
                <a href="{{ $materi->content_url }}" class="inline-flex items-center justify-center w-full md:w-auto px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-sm gap-2" target="_blank">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Akses Tautan Materi
                </a>
            </div>
        </div>
    @else
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 text-center">
            <div class="text-6xl mb-4 opacity-50">📭</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Materi</h3>
            <p class="text-slate-500">Materi pembelajaran untuk mata pelajaran Anda belum ditambahkan oleh administrator.</p>
        </div>
    @endif
</div>
@endsection
