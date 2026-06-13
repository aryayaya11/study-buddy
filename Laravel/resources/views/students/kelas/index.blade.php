@extends('layouts.app')
@section('title', 'Kelas Saya')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📚 Kelas Saya</h2>
            <p class="text-slate-500 text-sm mt-1">Daftar kelas yang sedang Anda ikuti.</p>
        </div>
    </div>

    @if($kelas->isEmpty())
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 text-center">
            <div class="text-6xl mb-4 opacity-50">🏖️</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Kelas</h3>
            <p class="text-slate-500 mb-6">Anda belum memiliki kelas aktif saat ini.</p>
            <a href="{{ route('students.pendaftaran.create') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Daftar Kelas Baru
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelas as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="font-bold text-blue-900 text-lg truncate">
                            {{ $item->mapel->nama_mapel ?? 'Mata Pelajaran' }}
                        </h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded border border-blue-200 uppercase">
                            {{ $item->mapel->jenjang ?? '-' }}
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="bg-slate-50 rounded-xl p-4 mb-6 border border-slate-100 flex-1">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Tautan Kelas (Zoom/Meet)</h4>
                            
                            <div class="space-y-3">
                                @forelse($item->mapel->materi->where('tipe', 'zoom') as $materiZoom)
                                    <div class="flex items-center gap-3 text-sm">
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        <a href="{{ $materiZoom->content_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline font-medium truncate w-full block">
                                            {{ $materiZoom->judul_materi }}
                                        </a>
                                    </div>
                                @empty
                                    <div class="flex items-center gap-3 text-sm">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                        <span class="text-slate-400 italic">Belum ada link materi</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <a href="{{ route('students.materi.index') }}" class="w-full py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Lihat Materi
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
