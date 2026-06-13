<?php

namespace App\Http\Controllers;

use App\Models\Kelas;

class StudentClassController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $pendaftaran = \App\Models\Pendaftaran::where('siswa_id', $user->user_id)
            ->whereHas('transaksi', function ($q) {
                $q->where('status_bayar', 'paid');
            })
            ->with('kelas.mapel', 'kelas.mapel.materi')
            ->get();

        // Ambil daftar kelas unik
        $kelas = $pendaftaran->pluck('kelas')->unique('kelas_id');

        return view('students.kelas.index', compact('kelas'));
    }
}