<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
{
    // Step 1: cek apakah method store() kepanggil
    \Log::debug('Masuk ke store()', $request->all());
    // Bisa juga pakai dd(), tapi kalau mau tetap jalan ke bawah gunakan Log

    // Step 2: validasi input
    $request->validate([
        'nama' => 'required|string|max:100',
        'jenis_kelamin' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'no_whatsapp' => 'required|string',
        'tanggal_lahir' => 'nullable|date',
        'password' => 'required|string|min:6',
    ]);
    \Log::debug('Lolos validasi', $request->all());

    // Step 3: create user
    $user = User::create([
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'email' => $request->email,
        'no_whatsapp' => $request->no_whatsapp,
        'tanggal_lahir' => $request->tanggal_lahir,
        'password' => Hash::make($request->password),
        'role' => 'siswa',
    ]);

    \Log::debug('User tersimpan?', $user->toArray());

    // Step 4: redirect kalau sukses
    return redirect()->route('home')->with('success', 'Pendaftaran berhasil!');
}

}