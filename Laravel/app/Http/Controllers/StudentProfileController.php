<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function edit()
    {
        return view('students.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'no_whatsapp' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'jenjang' => 'required|string|max:10'
        ]);

        $user->nama = $request->nama;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_whatsapp = $request->no_whatsapp;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->save();

        // Update tabel siswa
        $siswa = $user->siswa; // pastikan relasi User -> Siswa ada
        if ($siswa) {
            $siswa->update([
                'jenjang' => $request->jenjang,
            ]);
        }
        // Reload the siswa relationship to reflect changes
        $user->load('siswa');
        return redirect()->route('students.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}