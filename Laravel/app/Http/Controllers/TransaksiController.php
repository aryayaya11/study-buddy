<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Menampilkan formulir pembayaran dan membuat record transaksi awal.
     */
    public function create(Pendaftaran $pendaftaran)
    {
        // Pastikan pendaftaran ini milik user yang login
        if ($pendaftaran->siswa_id !== Auth::user()->user_id) {
            return redirect()->route('students.dashboard')
                ->with('error', 'Akses ditolak.');
        }

        // Ambil data kelas dan hitung harga
        $kelas = $pendaftaran->kelas;
        if (!$kelas) {
            return redirect()->route('students.dashboard')
                ->with('error', 'Data kelas tidak ditemukan untuk pendaftaran ini.');
        }

        // Konversi durasi dari "3_bulan" menjadi angka 3
        $durasi_angka = (int) strtok($pendaftaran->durasi, '_');
        $harga_dasar  = $kelas->harga;
        $jumlah_bayar = $harga_dasar * $durasi_angka;

        // Cek apakah transaksi sudah ada
        $transaksi = Transaksi::where('pendaftaran_id', $pendaftaran->daftar_id)->first();

        // Kalau belum ada, buat transaksi baru
        if (!$transaksi) {
            $transaksi = Transaksi::create([
                'pendaftaran_id' => $pendaftaran->daftar_id,
                'metode_bayar'   => 'transfer',
                'jumlah'         => $jumlah_bayar,
                'status_bayar'   => 'pending',
            ]);

            // Simpan ID transaksi di pendaftaran
            $pendaftaran->transaksi_id = $transaksi->transaksi_id;
            $pendaftaran->save();
        }

        // Kirim data lengkap ke view
        return view('students.transaksi.create', [
            'pendaftaran' => $pendaftaran,
            'transaksi'   => $transaksi,
            'harga'       => $jumlah_bayar,
        ]);
    }

    /**
     * Proses penyimpanan bukti pembayaran.
     */
    public function store(Request $request, Pendaftaran $pendaftaran)
    {
        // ✅ Validasi input (hapus ewallet)
        $request->validate([
            'metode_bayar' => 'required|string|in:transfer,qris',
            'jumlah'       => 'required|numeric|min:1',
            'bukti'        => 'required|image|max:2048',
        ]);

        // Pastikan pendaftaran milik user yang login
        if ($pendaftaran->siswa_id !== Auth::user()->user_id) {
            return redirect()->route('students.dashboard')
                ->with('error', 'Akses ditolak.');
        }

        $transaksi = $pendaftaran->transaksi;
        if (!$transaksi) {
            return back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Simpan bukti ke folder storage/public/bukti_pembayaran
        $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');

        // Update transaksi
        $transaksi->update([
            'metode_bayar' => $request->metode_bayar,
            'jumlah'       => $request->jumlah,
            'status_bayar' => 'menunggu_verifikasi',
            'bukti_bayar'  => $buktiPath,
        ]);

        return redirect()->route('students.dashboard')
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }
}
