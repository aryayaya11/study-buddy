<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Menampilkan halaman contact
    public function index()
    {
        return view('home.contact');
    }

    // Proses kirim pesan
    public function send(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string|max:500',
        ]);

        // 📌 opsi 1: Simpan ke database (jika punya tabel messages)
        // Message::create($request->all());

        // 📌 opsi 2: Kirim email (butuh konfigurasi MAIL di .env)
        /*
        Mail::raw($request->pesan, function ($message) use ($request) {
            $message->to('studybuddy@gmail.com')
                    ->subject('Pesan Baru dari ' . $request->nama)
                    ->from($request->email);
        });
        */

        return back()->with('success', 'Pesan kamu berhasil dikirim! 🎉');
    }
}