@extends('layouts.home_layout')

@section('content')
  <section class="hero bg-blue-600 text-white py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-5xl md:text-6xl font-light mb-6">
        Program Sekolah Dasar (SD)
      </h1>
      <p class="text-xl md:text-2xl mb-12 opacity-90">
        Belajar membaca, menulis, berhitung, dan pengembangan kreativitas dengan metode yang menyenangkan dan interaktif.
      </p>
      <a href="{{ route('register.create') }}?level=sd" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300">
        Daftar Sekarang
      </a>
    </div>
  </section>


  <section class="content bg-white py-24 px-4">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-light text-center text-blue-900 mb-16">Materi Pembelajaran Lengkap</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-2xl">📖 Bahasa Indonesia</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Pembelajaran membaca dan menulis dengan metode fonetik, pemahaman teks, dan pengembangan kosakata melalui cerita interaktif dan permainan edukatif.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-2xl">🔢 Matematika</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Konsep dasar berhitung, pengenalan geometri, logika matematika, dan problem solving melalui aktivitas hands-on dan visual learning.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-2xl">🌍 IPAS</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Eksplorasi dunia sekitar melalui eksperimen sederhana, pengenalan sejarah sosiologi, dan pemahaman konsep dasar sains dengan pendekatan inquiry based learning menggabungkan IPA dan IPS.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-2xl">🎨 Bahasa Inggris</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Academic writing, dan advanced grammar. Persiapan untuk tingkat lanjut dan persiapan lomba nasional/internasional.
          </p>
        </div>

  </section>

  <section class="cta bg-blue-600 py-16 px-4">
    <div class="max-w-4xl mx-auto text-center text-white">
      <h2 class="text-3xl font-light mb-6">Siap Memulai Petualangan Belajar?</h2>
      <p class="text-xl mb-8 opacity-90">Bergabunglah dengan ribuan siswa SD yang telah sukses bersama Study Buddy</p>
      <a href="{{ route('register.create') }}?level=sd" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300">
        Daftar Sekarang
      </a>
    </div>
  </section>
@endsection
