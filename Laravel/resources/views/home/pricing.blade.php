@extends('layouts.home_layout')

@section('title', 'Biaya dan Pendaftaran')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-900 mb-4">Biaya dan Pendaftaran</h1>
        <p class="text-lg text-gray-600">Informasi lengkap tentang biaya kursus dan proses pendaftaran</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Pricing Information -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 border border-blue-200">
            <h2 class="text-3xl font-bold text-blue-900 mb-6 text-center">Struktur Biaya</h2>
            <div class="text-center mb-8">
                <p class="text-xl text-blue-700 font-semibold">program pembelajaran dibagi ke dalam tiga tingkatan kelas berdasarkan jenjang pendidikan, dengan biaya yang fleksibel mulai dari Rp100.000/bulan</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Level 1 -->
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Sekolah Dasar</h3>
                    <div class="text-3xl font-bold text-blue-600 mb-2">Rp 100.000</div>
                    <p class="text-gray-600 mb-4">per bulan</p>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>✓ Materi dasar</li>
                        <li>✓ Tutor berpengalaman</li>
                        <li>✓ Akses materi online</li>
                    </ul>
                </div>

                <!-- Level 2 -->
                <div class="bg-blue-100 p-6 rounded-lg border border-blue-300">
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Sekolah Menengah Pertama</h3>
                    <div class="text-3xl font-bold text-blue-600 mb-2">Rp 150.000</div>
                    <p class="text-gray-600 mb-4">per bulan</p>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>✓ Materi lanjutan</li>
                        <li>✓ Latihan soal tambahan</li>
                        <li>✓ Konsultasi pribadi serta akses materi online</li>
                    </ul>
                </div>

                <!-- Level 3 -->
                <div class="bg-blue-200 p-6 rounded-lg border border-blue-400">
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Sekolah Menengah Atas</h3>
                    <div class="text-3xl font-bold text-blue-600 mb-2">Rp 200.000</div>
                    <p class="text-gray-600 mb-4">per bulan</p>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>✓ Materi premium</li>
                        <li>✓ Mock test & simulasi ujian</li>
                        <li>✓ Mentoring intensif</li>
                        <li>✓ Konsultasi pribadi serta akses materi online</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Registration Process -->
        <div class="bg-white rounded-lg shadow-lg p-8 border border-blue-200">
            <h2 class="text-3xl font-bold text-blue-900 mb-6 text-center">Proses Pendaftaran</h2>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-4">Langkah-langkah Pendaftaran:</h3>
                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                        <li>Daftar akun di website Study Buddy</li>
                        <li>Pilih jenjang pendidikan (SD/SMP/SMA)</li>
                        <li>Pilih mata pelajaran yang diinginkan</li>
                        <li>Tentukan durasi program</li>
                        <li>Pilih jadwal sesi belajar</li>
                        <li>Lakukan pembayaran sesuai paket yang dipilih</li>
                        <li>Mulai belajar dengan tutor terbaik!</li>
                    </ol>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-4">Informasi Tambahan:</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li>✓ Pembayaran bulanan atau paket (1/3/6 bulan)</li>
                        <li>✓ Tutor bersertifikat dan berpengalaman</li>
                        <li>✓ Fleksibilitas jadwal belajar</li>
                        <li>✓ Platform pembelajaran online 24/7</li>
                    </ul>

                    <div class="mt-6">
                        <a href="{{ route('register.create') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
