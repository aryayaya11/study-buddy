<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class TutorDashboardController extends Controller
{
    public function index()
    {
        $tutor = Auth::user(); // Pastikan user yang login adalah tutor

        // Ambil semua kelas yang dia ampu
        $kelas = Kelas::with('siswa', 'mapel.materi')
                      ->where('tutor_id', $tutor->tutor_id)
                      ->get();

        // Hitung ringkasan
        $jumlahKelas = $kelas->count();
        $jumlahSiswa = $kelas->pluck('siswa')->flatten()->count();
        $jumlahMateri = $kelas->pluck('mapel')->flatten()->pluck('materi')->flatten()->count();

        // Bisa juga ambil kelas hari ini (opsional)
        $hariIni = now()->format('l'); // misal: "Monday"
        $kelasHariIni = $kelas->filter(function($k) use ($hariIni) {
            return optional($k->jadwalSesi)->hari == $hariIni;
        });

        return view('tutor.dashboard', compact(
            'tutor',
            'jumlahKelas',
            'jumlahSiswa',
            'jumlahMateri',
            'kelasHariIni'
        ));
    }
}