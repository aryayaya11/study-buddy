<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Pendaftaran;

class StudentMateriController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil pendaftaran dengan status bayar sukses
        $pendaftaran = \App\Models\Pendaftaran::where('siswa_id', $user->user_id)
            ->whereHas('transaksi', function ($q) {
                $q->where('status_bayar', 'paid');
            })
            ->with('kelas.mapel')
            ->get();

        // Ambil mapel_id unik dari pendaftaran
        $mapelIds = $pendaftaran->pluck('kelas.mapel.mapel_id')->filter()->unique();

        // Ambil materi sesuai mapel_id, tapi hanya yang tipe = 'pdf'
        $materi = \App\Models\Materi::whereIn('mapel_id', $mapelIds)
            ->where('tipe', 'pdf')
            ->get();

        return view('students.materi', compact('materi'));
    }

}