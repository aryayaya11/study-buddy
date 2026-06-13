<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelasPendaftaran;
use App\Models\Pendaftaran;
use App\Models\Mapel;
use App\Models\Tutor;
use App\Models\KelasKelas;

class AdminClassController extends Controller
{
    public function index(Request $request)
    {
        $filterJenjang = $request->input('jenjang');
        $filterMapel   = $request->input('mapel_id');

        // Ambil semua jenjang unik
        $jenjangList = KelasPendaftaran::select('jenjang')->distinct()->pluck('jenjang');

        // Filter mapel berdasarkan jenjang
        if ($filterJenjang) {
            $mapelIds = KelasPendaftaran::where('jenjang', $filterJenjang)
                ->distinct()
                ->pluck('mapel_id')
                ->toArray();

            $mapelList = Mapel::whereIn('mapel_id', $mapelIds)->orderBy('nama_mapel')->get();
        } else {
            $mapelList = Mapel::orderBy('nama_mapel')->get();
        }

        // Query kelas
        $query = KelasPendaftaran::with(['mapel'])
            ->select('jenjang', 'mapel_id', 'harga')
            ->groupBy('jenjang', 'mapel_id', 'harga')
            ->orderBy('jenjang');

        if ($filterJenjang) $query->where('jenjang', $filterJenjang);
        if ($filterMapel) $query->where('mapel_id', $filterMapel);

        // Ambil hasil + semua siswa terdaftar
        $kelasList = $query->get()->map(function ($kelas) {
            $pendaftaran = Pendaftaran::whereHas('kelas', function ($q) use ($kelas) {
                    $q->where('jenjang', $kelas->jenjang)
                      ->where('mapel_id', $kelas->mapel_id);
                })
                ->with('siswaData')
                ->get()
                ->map(function ($p) {
                    // Tambahkan data tutor jika sudah assigned
                    $assignment = KelasKelas::where('kelas_id', $p->kelas_id)
                        ->where('siswa_id', $p->siswa_id)
                        ->with('tutor.user')
                        ->first();
                    $p->tutor_assignment = $assignment;
                    return $p;
                });

            $kelas->pendaftaran = $pendaftaran;
            return $kelas;
        });

        return view('admin.classes.index', compact(
            'kelasList',
            'jenjangList',
            'mapelList',
            'filterJenjang',
            'filterMapel'
        ));
    }

    // Tambahkan tutor ke kelas
    public function assignTutor(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'siswa_id' => 'required',
            'tutor_id' => 'required',
        ]);

        // Simpan atau update ke tabel kelas_kelas
        KelasKelas::updateOrCreate(
            [
                'kelas_id' => $request->kelas_id,
                'siswa_id' => $request->siswa_id,
            ],
            [
                'tutor_id' => $request->tutor_id,
            ]
        );

        return redirect()->route('admin.classes')
            ->with('success', 'Tutor berhasil ditambahkan ke kelas!');
    }

    // AJAX get mapel per jenjang
    public function getMapelByJenjang(Request $request)
    {
        $jenjang = $request->input('jenjang');
        if (!$jenjang) return response()->json([]);

        $mapelIds = KelasPendaftaran::where('jenjang', $jenjang)
            ->distinct()
            ->pluck('mapel_id')
            ->toArray();

        $mapelList = Mapel::whereIn('mapel_id', $mapelIds)
            ->orderBy('nama_mapel')
            ->get(['mapel_id', 'nama_mapel']);

        return response()->json($mapelList);
    }
}