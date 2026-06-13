<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Tutor;
use App\Models\Kelas;
use App\Models\Pendaftaran; // atau Enrollment
use App\Models\Admin; // jika ada tabel admin
use App\Models\Jadwal;

class AdminDashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        return view('admin.dashboard');
    }

    // Manajemen Siswa
    public function students()
    {
        $students = Siswa::with('user')->get();

        return view('admin.students', compact('students'));
    }

    // Manajemen Tutor
    public function tutors()
    {
        $tutors = Tutor::with('user')->get();
        return view('admin.tutors', compact('tutors'));
    }

    // Manajemen Kelas
    public function classes()
    {
        $classes = Kelas::with('siswa.user', 'tutor.user', 'mapel', 'jadwal')->get();
        return view('admin.classes', compact('classes'));
    }

    // Manajemen Pendaftaran
    public function enrollments()
    {
        $enrollments = Pendaftaran::with('siswa.user', 'mapel', 'transaksi')->get();
        return view('admin.enrollments', compact('enrollments'));
    }

    // Manajemen Admin
    public function admins()
    {
        $admins = User::where('role', 'admin')->get();

        return view('admin.admins', compact('admins'));
    }
}