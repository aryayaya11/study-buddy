<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminEnrollmentController extends Controller
{
    /**
     * Tampilkan semua transaksi dengan data siswa dan kelas.
     */
    public function index()
    {
        $transaksi = Transaksi::with(['pendaftaran.kelas.mapel', 'pendaftaran.siswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.enrollments.index', compact('transaksi'));
    }

    /**
     * Update status pembayaran oleh admin.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_bayar' => 'required|in:paid,failed,pending,menunggu_verifikasi',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_bayar = $request->status_bayar;
        $transaksi->save();

        return redirect()->route('admin.enrollments')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
