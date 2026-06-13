<?php

use Illuminate\Support\Facades\Route;

// Import semua controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentMateriController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\TutorClassController;
use App\Http\Controllers\TutorMateriController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEnrollmentController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminClassController;
use App\Http\Controllers\Admin\AdminTutorController;
use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TransaksiController;

// ==================== AUTH ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// ✅ Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==================== STUDENT ROUTES ====================
Route::prefix('students')->name('students.')
    ->middleware(['auth', 'role:siswa'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('students.dashboard');
        })->name('dashboard');

        // Profile
        Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');

        // Materi & Kelas
        Route::get('/materi', [StudentMateriController::class, 'index'])->name('materi.index');
        Route::get('/kelas', [StudentClassController::class, 'index'])->name('kelas.index');

        // Pendaftaran Kelas
        Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        // AJAX Endpoints
        Route::get('/kelas/get-mapel', [PendaftaranController::class, 'getMapelByJenjang'])->name('kelas.getMapel');
        Route::get('/kelas/get-harga', [PendaftaranController::class, 'getHarga'])->name('kelas.getHarga');

        // Transaksi (Setelah Pendaftaran)
        Route::get('/transaksi/{pendaftaran}', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/transaksi/{pendaftaran}', [TransaksiController::class, 'store'])->name('transaksi.store');
    });


// ==================== TUTOR ROUTES ====================
Route::prefix('tutor')->name('tutor.')
    ->middleware(['auth', 'role:tutor'])
    ->group(function () {

        Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');

        // Classes
        Route::get('/classes', [TutorClassController::class, 'index'])->name('classes');

        // Materials
        Route::get('/materials', [TutorMateriController::class, 'index'])->name('materials');

        // Profile
        Route::get('/profile', [TutorProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [TutorProfileController::class, 'update'])->name('profile.update');
    });


// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Siswa
        Route::get('/students', [AdminStudentController::class, 'index'])->name('students');

        // Manajemen Kelas
        Route::get('/classes', [AdminClassController::class, 'index'])->name('classes');
        Route::get('/classes/get-mapel', [AdminClassController::class, 'getMapelByJenjang'])->name('classes.getMapel');

        // NEW: route untuk assign tutor ke pendaftaran (form di halaman kelas)
        Route::post('/classes/assign-tutor', [AdminClassController::class, 'assignTutor'])->name('classes.assignTutor');

        // Manajemen Pendaftaran & Pembayaran
        Route::get('/enrollments', [AdminEnrollmentController::class, 'index'])->name('enrollments');
        Route::post('/enrollments/{id}/update', [AdminEnrollmentController::class, 'updateStatus'])->name('enrollments.update');

        // Manajemen Tutor
        Route::get('/tutors', [AdminTutorController::class, 'index'])->name('tutors');
        Route::post('/tutors', [AdminTutorController::class, 'store'])->name('tutors.store');
        Route::delete('/tutors/{id}', [AdminTutorController::class, 'destroy'])->name('tutors.destroy');

        // ✅ Manajemen Admin (semua fungsi disertakan)
        Route::get('/admins', [AdminAdminController::class, 'index'])->name('admins');
        Route::get('/admins/create', [AdminAdminController::class, 'create'])->name('admins.create');
        Route::post('/admins', [AdminAdminController::class, 'store'])->name('admins.store');
        Route::put('/admins/{user_id}', [AdminAdminController::class, 'update'])->name('admins.update'); // ✅ fix untuk edit admin
        Route::delete('/admins/{user_id}', [AdminAdminController::class, 'destroy'])->name('admins.destroy');
    });

// Statistics Route (inside admin middleware group)
Route::get('/admin/statistics', [StatisticController::class, 'index'])->name('admin.statistics')->middleware(['auth', 'role:admin']);
Route::get('/admin/statistics/registrants/{subjectName}', [StatisticController::class, 'getRegistrantsBySubject'])->name('admin.statistics.registrants')->middleware(['auth', 'role:admin']);


// ==================== PUBLIC/GUEST ROUTES ====================

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Landing Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/program', [HomeController::class, 'program'])->name('program');
Route::get('/program/sd', [HomeController::class, 'programSD'])->name('program.sd');
Route::get('/program/smp', [HomeController::class, 'programSMP'])->name('program.smp');
Route::get('/program/sma', [HomeController::class, 'programSMA'])->name('program.sma');
Route::get('/biaya', [HomeController::class, 'pricing'])->name('pricing');

// Registrasi Akun
Route::get('/daftar', [RegistrationController::class, 'create'])->name('register.create');
Route::post('/daftar', [RegistrationController::class, 'store'])->name('daftar.store');