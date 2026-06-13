<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelasKelas;
use Carbon\Carbon;

class TutorClassController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tutor_id = $user->tutor->tutor_id ?? null;

        // daftar nama hari yang valid sesuai tabel jadwal_sesi enum
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat'];

        // ambil param day dari query string (mis. ?day=Rabu)
        $selectedDay = $request->query('day');

        // jika tidak ada param, default ke hari ini (hanya weekday Senin-Jumat)
        if (!$selectedDay) {
            // dayOfWeekIso: 1 (Mon) .. 7 (Sun)
            $iso = Carbon::now()->isoFormat('E'); // returns 1..7 as string in some setups; use dayOfWeekIso
            $isoInt = Carbon::now()->dayOfWeekIso; // 1..7
            // map ke nama
            if ($isoInt >= 1 && $isoInt <= 5) {
                $selectedDay = $days[$isoInt - 1];
            } else {
                // jika weekend, default ke Senin
                $selectedDay = 'Senin';
            }
        }

        // Ambil kelas yang diajar tutor ini dan memiliki jadwal pada hari terpilih
        $classes = collect();
        if ($tutor_id) {
            $classes = KelasKelas::with(['kelas.mapel.materi', 'kelas.jadwal', 'siswa.user'])
                ->where('tutor_id', $tutor_id)
                ->whereHas('kelas.jadwal', function ($q) use ($selectedDay) {
                    $q->where('hari', $selectedDay);
                })
                ->get();
        }

        return view('tutor.classes', compact('classes', 'selectedDay'));
    }
}
