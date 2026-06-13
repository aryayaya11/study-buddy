@extends('layouts.tutor_layouts')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Kelas</h2>

    {{-- Tombol Hari --}}
    @php
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    @endphp
    <div class="flex justify-around text-center mb-6 border-b border-gray-400">
        @foreach($days as $day)
            <a href="{{ route('tutor.classes', ['day' => $day]) }}"
               class="px-4 py-2 text-gray-800 border-b-2 transition 
                      {{ $selectedDay === $day ? 'border-gray-800 font-bold' : 'border-transparent hover:border-gray-800' }}">
                {{ strtoupper($day) }}
            </a>
        @endforeach
    </div>

    {{-- Daftar Kelas --}}
    @if($classes->isEmpty())
        <p class="text-white text-center">Tidak ada kelas pada hari {{ $selectedDay }}.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($classes as $class)
                <div class="bg-orange-200 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">
                        {{ $class->mapel->nama ?? 'Tanpa Nama Mapel' }}
                    </h3>

                    <p class="text-sm text-gray-800 mb-1">
                        {{ $class->siswa->user->nama ?? 'Tanpa Nama Siswa' }}
                    </p>

                    <p class="text-sm flex items-center mb-1 text-gray-800">
                        <span class="mr-2">⏰</span> 
                        {{ optional($class->jadwalSesi)->jam_mulai }} - {{ optional($class->jadwalSesi)->jam_selesai }}
                    </p>

                    <p class="text-sm flex items-center mb-4 text-gray-800">
                        <span class="mr-2">🎓</span> {{ $class->jenjang ?? '-' }}
                    </p>

                    <button class="w-full py-2 bg-green-700 text-white rounded-md hover:bg-green-800">
                        Hadiri Kelas
                    </button>
                </div>
            @endforeach
        </div>
    @endif
@endsection
