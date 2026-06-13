@extends('layouts.app_admin')

@section('title', 'Manajemen Siswa')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">🎓 Daftar Siswa Aktif</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola data siswa yang telah dikonfirmasi aktif.</p>
        </div>
    </div>

    @if($students->isEmpty())
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 text-center">
            <div class="text-6xl mb-4 opacity-50">📭</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Data</h3>
            <p class="text-slate-500">Belum ada siswa yang pembayarannya dikonfirmasi berhasil.</p>
        </div>
    @else
        <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                            <th class="px-6 py-4">ID Siswa</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4 text-right">No WhatsApp</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($students as $student)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4 text-slate-600 font-medium">#{{ $student->user_id }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-800">{{ $student->nama }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $student->email }}</td>
                                <td class="px-6 py-4 text-right">
                                    @if($student->no_whatsapp)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-green-50 text-green-700 font-medium text-sm border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            {{ $student->no_whatsapp }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 italic">Kosong</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
