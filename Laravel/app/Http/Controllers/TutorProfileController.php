<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorProfileController extends Controller
{
    public function edit()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // pastikan hanya tutor
        if (!$user->isTutor()) {
            abort(403, 'Anda bukan tutor.');
        }

        return view('tutor.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required',
            'no_whatsapp' => 'required',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $user->update($request->only('nama', 'jenis_kelamin', 'no_whatsapp', 'tanggal_lahir'));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}