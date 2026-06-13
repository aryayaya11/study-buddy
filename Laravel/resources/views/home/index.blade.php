@extends('layouts.home_layout')

@section('content')
  <section class="hero bg-blue-800 text-white py-32 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-3 items-center gap-12">
        <div class="flex justify-center lg:justify-end">
          <div class="w-48 h-64 bg-blue-600 rounded-full flex items-center justify-center shadow-2xl">
            <span class="text-8xl">👨‍🎓</span>
          </div>
        </div>

        <div class="text-center px-8">
          <h1 class="text-4xl md:text-5xl font-light mb-6 leading-tight">
            Tutor Online Terpercaya untuk <span class="text-blue-300 font-medium">Generasi Juara</span>
          </h1>
          <p class="text-lg md:text-xl mb-12 text-blue-100 font-light">
            Raih prestasi akademik terbaik dengan bimbingan tutor profesional dan metode pembelajaran inovatif.
          </p>
          <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ route('register.create') }}" class="bg-blue-600 text-white font-medium py-4 px-10 rounded-lg text-lg hover:bg-blue-700 transition-colors duration-300">
              Daftar Sekarang
            </a>
            <a href="{{ route('contact') }}" class="bg-blue-600 text-white font-medium py-4 px-10 rounded-lg text-lg hover:bg-blue-600 transition-colors duration-300">
              Konsultasi Gratis
            </a>
          </div>
        </div>

        <div class="flex justify-center lg:justify-start">
          <div class="w-48 h-64 bg-blue-600 rounded-full flex items-center justify-center shadow-2xl">
            <span class="text-8xl">👩‍</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="about bg-gradient-to-b from-blue-50 to-white py-24 px-4">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-light text-center text-blue-900 mb-16">Tentang Kami</h2>
      <div class="text-center mb-16">
        <p class="text-xl text-gray-600 leading-relaxed max-w-4xl mx-auto">
          Study Buddy adalah platform bimbingan belajar online yang berkomitmen untuk memberikan pendidikan berkualitas tinggi kepada generasi muda Indonesia. Dengan tutor-tutor berpengalaman dan metode pembelajaran inovatif, kami membantu siswa mencapai potensi maksimal mereka.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <a href="{{ route('program.sd') }}" class="block text-center bg-gradient-to-br from-blue-100 to-blue-200 p-8 rounded-xl hover:from-blue-200 hover:to-blue-300 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl transform border border-blue-200">
          <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4 rounded-full mx-auto mb-4 w-fit shadow-md">
            <span class="text-white text-3xl">📚</span>
          </div>
          <h3 class="text-xl font-semibold text-blue-900 mb-2">Sekolah Dasar</h3>
          <p class="text-blue-700 text-sm font-medium">Belajar dasar dengan metode interaktif</p>
        </a>

        <a href="{{ route('program.smp') }}" class="block text-center bg-gradient-to-br from-blue-100 to-blue-200 p-8 rounded-xl hover:from-blue-200 hover:to-blue-300 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl transform border border-blue-200">
          <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4 rounded-full mx-auto mb-4 w-fit shadow-md">
            <span class="text-white text-3xl">🎓</span>
          </div>
          <h3 class="text-xl font-semibold text-blue-900 mb-2">Sekolah Menengah Pertama</h3>
          <p class="text-blue-700 text-sm font-medium">Persiapan ujian dengan pemahaman mendalam</p>
        </a>

        <a href="{{ route('program.sma') }}" class="block text-center bg-gradient-to-br from-blue-100 to-blue-200 p-8 rounded-xl hover:from-blue-200 hover:to-blue-300 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl transform border border-blue-200">
          <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4 rounded-full mx-auto mb-4 w-fit shadow-md">
            <span class="text-white text-3xl">🏆</span>
          </div>
          <h3 class="text-xl font-semibold text-blue-900 mb-2">Sekolah Menengah Atas</h3>
          <p class="text-blue-700 text-sm font-medium">Strategi belajar untuk prestasi maksimal</p>
        </a>
      </div>
    </div>
  </section>

  <section class="stats bg-blue-600 py-24 px-4">
    <div class="text-center px-8">
      <h2 class="text-4xl font-light mb-16 text-center flex justify-center">Bergabunglah dengan Ribuan Siswa Sukses</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <div>
          <div class="text-6xl font-light mb-4" id="student-count">0</div>
          <p class="text-xl">Siswa yang telah belajar bersama kami</p>
        </div>
        <div>
          <div class="text-6xl font-light mb-4">50+</div>
          <p class="text-xl">Tutor berpengalaman</p>
        </div>
        <div>
          <div class="text-6xl font-light mb-4">100%</div>
          <p class="text-xl">Kepuasan siswa</p>
        </div>
      </div>
    </div>
  </section>

  <script>
    function animateCounter(element, target) {
      let current = 0;
      const increment = target / 100;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        element.textContent = Math.floor(current) + '+';
      }, 30);
    }

    document.addEventListener('DOMContentLoaded', () => {
      const studentCount = document.getElementById('student-count');
      animateCounter(studentCount, 1000);
    });
  </script>
@endsection