<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Tutor;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Models\Jadwal;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama admin.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Menampilkan daftar semua siswa.
     *
     * @return \Illuminate\View\View
     */
    public function students()
    {
        // Mengambil semua data siswa beserta data user terkait
        $students = Siswa::with('user')->get();
        return view('admin.students', compact('students'));
    }

    /**
     * Menampilkan daftar semua kelas.
     *
     * @return \Illuminate\View\View
     */
    public function classes()
    {
        // Mengambil data kelas dengan relasi yang diperlukan (siswa, tutor, mapel, jadwal)
        $classes = Kelas::with(['siswa.user', 'tutor.user', 'mapel', 'jadwal'])->get();
        return view('admin.classes', compact('classes'));
    }

    /**
     * Menampilkan daftar semua pendaftaran.
     *
     * @return \Illuminate\View\View
     */
    public function enrollments()
    {
        // Mengambil data pendaftaran dengan relasi yang diperlukan (siswa, mapel, transaksi)
        $enrollments = Pendaftaran::with(['siswa.user', 'mapel', 'transaksi'])->get();
        return view('admin.enrollments', compact('enrollments'));
    }

    /**
     * Menampilkan daftar semua tutor.
     *
     * @return \Illuminate\View\View
     */
    public function tutors()
    {
        // Mengambil semua data tutor beserta data user terkait
        $tutors = Tutor::with('user')->get();
        return view('admin.tutors', compact('tutors'));
    }

    /**
     * Menampilkan daftar semua admin.
     *
     * @return \Illuminate\View\View
     */
    public function admins()
    {
        // Mengambil data user yang memiliki peran 'admin'
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins', compact('admins'));
    }
}