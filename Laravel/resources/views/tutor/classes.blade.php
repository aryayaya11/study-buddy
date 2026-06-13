@extends('layouts.tutor_layouts')
@section('title', 'Daftar Kelas')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📚 Daftar Kelas</h2>
            <p class="text-slate-500 text-sm mt-1">Pantau jadwal mengajar Anda berdasarkan hari.</p>
        </div>
    </div>

    @php
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        $selectedDay = $selectedDay ?? 'Senin';
    @endphp

    {{-- Tabs Hari --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-2 mb-8 inline-flex flex-wrap gap-2 w-full md:w-auto">
        @foreach($days as $day)
            <a href="{{ route('tutor.classes', ['day' => $day]) }}"
                class="flex-1 md:flex-none text-center px-6 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 
                {{ $selectedDay === $day 
                    ? 'bg-blue-600 text-white shadow-md' 
                    : 'text-slate-600 hover:bg-slate-100 hover:text-blue-600' }}">
                {{ strtoupper($day) }}
            </a>
        @endforeach
    </div>

    @if($classes->isEmpty())
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 text-center">
            <div class="text-6xl mb-4 opacity-50">🏖️</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Hari Bebas Mengajar</h3>
            <p class="text-slate-500">Tidak ada jadwal kelas untuk Anda pada hari <strong class="text-blue-600">{{ $selectedDay }}</strong>.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($classes as $class)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="font-bold text-blue-900 text-lg truncate">
                            {{ optional($class->kelas->mapel)->nama_mapel ?? 'Mata Pelajaran' }}
                        </h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded border border-blue-200 uppercase">
                            {{ $class->kelas->jenjang ?? '-' }}
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 font-bold">
                                {{ strtoupper(substr(optional(optional($class->siswa)->user)->nama ?? 'S', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Siswa</p>
                                <p class="text-sm font-bold text-slate-800">
                                    {{ optional(optional($class->siswa)->user)->nama ?? (optional($class->siswa)->user_id ?? '-') }}
                                </p>
                            </div>
                        </div>

                        @php
                            $sesiLabel = optional($class->kelas->jadwal)->sesi ? 'Sesi '.optional($class->kelas->jadwal)->sesi : '-';
                        @endphp

                        <div class="bg-slate-50 rounded-xl p-4 mb-6 border border-slate-100 flex-1">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Detail Jadwal</h4>
                            
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-sm">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-slate-700 font-medium">{{ $sesiLabel }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                    @if(optional($class->kelas->mapel)->materi->isNotEmpty())
                                        <a href="{{ $class->kelas->mapel->materi->first()->content_url }}" class="text-blue-600 hover:text-blue-800 hover:underline font-medium truncate w-full block" target="_blank">Link Zoom / Meet</a>
                                    @else
                                        <span class="text-slate-400 italic">Belum ada link materi</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button class="w-full py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            Mulai Kelas
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
