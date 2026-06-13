<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminTutorController extends Controller
{
    public function index()
    {
        // Ambil semua tutor beserta user dan mapel-nya
        $tutors = Tutor::with(['user', 'mapel'])->get();

        // Ambil semua mapel untuk dropdown tambah tutor
        $mapels = Mapel::all();

        return view('admin.tutors.index', compact('tutors', 'mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tutor' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'mapel_id' => 'required|exists:mapel,mapel_id',
        ]);

        // ✅ Generate ID otomatis (misal T001, T002, T003...)
        $lastNumber = Tutor::selectRaw("CAST(SUBSTRING(tutor_id, 2) AS UNSIGNED) AS num")
            ->orderBy('num', 'desc')
            ->value('num');

        $newNumber = $lastNumber ? $lastNumber + 1 : 1;
        $newTutorId = 'T' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // ✅ Tambahkan data user baru
        User::create([
            'user_id' => $newTutorId,
            'nama' => $request->nama_tutor,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'tutor',
        ]);

        // ✅ Tambahkan data tutor
        Tutor::create([
            'tutor_id' => $newTutorId,
            'mapel_id' => $request->mapel_id,
            'pengalaman' => $request->pengalaman ?? null,
            'rating' => $request->rating ?? null,
            'is_active' => 1,
        ]);

        return back()->with('success', "Tutor {$request->nama_tutor} berhasil ditambahkan!");
    }

    public function destroy($id)
    {
        // Hapus dari kedua tabel
        Tutor::where('tutor_id', $id)->delete();
        User::where('user_id', $id)->where('role', 'tutor')->delete();

        return back()->with('success', 'Tutor berhasil dihapus!');
    }
}