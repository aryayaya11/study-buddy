@extends('layouts.home_layout')

@section('content')
  <section class="hero bg-blue-600 text-white py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-5xl md:text-6xl font-light mb-6">
        Program Sekolah Menengah Atas (SMA)
      </h1>
      <p class="text-xl md:text-2xl mb-12 opacity-90">
        Persiapan UTBK, materi mendalam, dan strategi belajar cerdas untuk meraih prestasi maksimal.
      </p>
      <a href="{{ route('register.create') }}?level=sma" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300">
        Daftar Sekarang
      </a>
    </div>
  </section>

  <section class="content bg-white py-24 px-4">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-light text-center text-blue-900 mb-16">Materi Pembelajaran Lengkap</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

        {{-- Bahasa Indonesia --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">📖 Bahasa Indonesia</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Analisis sastra, retorika, dan keterampilan akademik. Persiapan untuk ujian nasional dan UTBK dengan fokus pada pemahaman kritis.
          </p>
        </div>

        {{-- Matematika --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🔢 Matematika</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Kalkulus, aljabar linear, geometri analitik, dan statistika. Pembelajaran intensif untuk persiapan UTBK Saintek dan Soshum.
          </p>
        </div>

        {{-- Fisika --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🧪 Fisika</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Mekanika, termodinamika, gelombang, dan fisika modern. Eksperimen virtual dan problem solving untuk UTBK Saintek.
          </p>
        </div>

        {{-- Kimia --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">⚗️ Kimia</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Stoikiometri, termokimia, kesetimbangan kimia, dan kimia organik. Laboratorium virtual dan aplikasi konsep kimia.
          </p>
        </div>

        {{-- Biologi --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🧬 Biologi</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Genetika, ekologi, fisiologi, dan bioteknologi. Studi kasus dan analisis data untuk pemahaman mendalam.
          </p>
        </div>

        {{-- Bahasa Inggris --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🌐 Bahasa Inggris</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            TOEFL/IELTS preparation, academic writing, dan advanced grammar. Persiapan untuk perguruan tinggi internasional.
          </p>
        </div>

        {{-- Sosiologi --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🏛️ Sosiologi</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Ekonomi, sosiologi, geografi, dan sejarah untuk UTBK Soshum. Analisis kritis dan studi kasus mendalam.
          </p>
        </div>

        {{-- Sejarah --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">📊 Sejarah</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Ekonomi, sosiologi, geografi, dan sejarah untuk UTBK Soshum. Analisis kritis dan studi kasus mendalam.
          </p>
        </div>

        {{-- Ekonomi --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🎯 Ekonomi</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Ekonomi, sosiologi, geografi, dan sejarah untuk UTBK Soshum. Analisis kritis dan studi kasus mendalam.
          </p>
        </div>

        {{-- Geografi --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">📈 Geografi</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Pengajaran hubungan antara manusia, tempat, dan lingkungan di permukaan bumi.
          </p>
        </div>

        {{-- Informatika --}}
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">💻 Informatika</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Pengajaran cara berpikir logis dan kreatif untuk memecahkan masalah menggunakan teknologi digital.
          </p>
        </div>

      </div>
    </div>
  </section>

  <section class="cta bg-blue-600 py-16 px-4">
    <div class="max-w-4xl mx-auto text-center text-white">
      <h2 class="text-3xl font-light mb-6">Siap Raih Prestasi Maksimal?</h2>
      <p class="text-xl mb-8 opacity-90">Bergabunglah dengan siswa SMA yang telah berhasil masuk PTN impian</p>
      <a href="{{ route('register.create') }}?level=sma" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300">
        Daftar Sekarang
      </a>
    </div>
  </section>
@endsection
