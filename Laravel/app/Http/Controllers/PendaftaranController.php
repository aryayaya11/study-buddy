<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\JadwalSesi;
use App\Models\KelasPendaftaran;
use App\Models\Pendaftaran;
use App\Models\Transaksi; // Wajib diimpor jika ingin menggunakan Transaksi::
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan form pendaftaran dengan daftar unik jenjang dan jadwal sesi.
     */
    public function create()
    {
        // Ambil daftar unik semua Jenjang yang tersedia dari tabel KelasPendaftaran
        $jenjang = KelasPendaftaran::select('jenjang')
                                   ->distinct()
                                   ->pluck('jenjang'); 

        // Ambil semua jadwal yang tersedia
        $jadwal = JadwalSesi::orderBy('hari')->orderBy('sesi')->get();

        return view('students.pendaftaran.create', compact('jenjang', 'jadwal'));
    }

    //--------------------------------------------------------------------------------------------------
    
    /**
     * AJAX: Mengambil daftar mata pelajaran berdasarkan Jenjang yang dipilih.
     */
    public function getMapelByJenjang(Request $request)
    {
        // Memaksa jenjang menjadi huruf kecil untuk query yang konsisten dengan DB
        $jenjang_db = strtolower($request->jenjang);
        
        $request->validate(['jenjang' => 'required|string|max:255']);

        $mapelIds = KelasPendaftaran::where('jenjang', $jenjang_db)
                                    ->pluck('mapel_id')
                                    ->unique();

        $mapel = Mapel::whereIn('mapel_id', $mapelIds)
                      ->orderBy('nama_mapel')
                      ->get(['mapel_id', 'nama_mapel']); 

        return response()->json($mapel);
    }

    //--------------------------------------------------------------------------------------------------

    /**
     * AJAX: Mengambil harga sesuai jenjang, mapel, dan jadwal yang dipilih.
     */
    public function getHarga(Request $request)
    {
        // Memaksa jenjang menjadi huruf kecil untuk query yang konsisten dengan DB
        $jenjang_db = strtolower($request->jenjang);
        
        $kelas = KelasPendaftaran::where('mapel_id', $request->mapel_id)
                                 ->where('jenjang', $jenjang_db)
                                 ->where('jadwal_id', $request->jadwal_id)
                                 ->first();

        return response()->json([
            'harga' => $kelas ? $kelas->harga : 0
        ]);
    }
    
    public function siswaData()
    {
        return $this->belongsTo(\App\Models\User::class, 'siswa_id', 'user_id');
    }

    

    //--------------------------------------------------------------------------------------------------

    /**
     * Menyimpan data pendaftaran baru ke database.
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Validasi mapel_id ke tabel 'mapel'
        $request->validate([
            'jenjang'   => 'required|string',
            'mapel_id'  => 'required|exists:mapel,mapel_id', 
            'durasi'    => 'required|integer',
            'jadwal_id' => 'required|exists:jadwal_sesi,jadwal_id',
        ]);

        // Memaksa jenjang menjadi huruf kecil untuk query yang konsisten dengan DB
        $jenjang_db = strtolower($request->jenjang);

        // Cari KelasPendaftaran berdasarkan kombinasi yang dipilih
        $kelas = KelasPendaftaran::where('mapel_id', $request->mapel_id)
                                 ->where('jenjang', $jenjang_db)
                                 ->where('jadwal_id', $request->jadwal_id)
                                 ->first();

        if (!$kelas) {
            // Ini akan muncul jika kombinasi Jenjang/Mapel/Sesi tidak ada di tabel kelas_pendaftaran
            return back()->with('error', 'Kelas tidak ditemukan untuk kombinasi Jenjang, Mata Pelajaran, dan Sesi yang dipilih.')->withInput();
        }

        // Konversi durasi dari integer menjadi format enum database (e.g., '3' -> '3_bulan')
        $durasi_db = $request->durasi . '_bulan';

        $pendaftaran = Pendaftaran::create([
            'siswa_id'       => Auth::user()->user_id,
            'kelas_id'       => $kelas->kelas_id,
            'status'         => 'pending',
            'tanggal_daftar' => now(),
            'durasi'         => $durasi_db,
            'transaksi_id'   => null,
        ]);

        // PERBAIKAN FINAL FLOW: Arahkan ke TransaksiController untuk membuat record transaksi
        return redirect()->route('students.transaksi.create', $pendaftaran->daftar_id)
                         ->with('success', 'Pendaftaran berhasil dibuat. Silakan lanjutkan ke pembayaran.');
    }
}
