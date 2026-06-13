@extends('layouts.home_layout')

@section('content')
  <section class="hero bg-blue-600 text-white py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-5xl md:text-6xl font-light mb-6">
        Program Sekolah Menengah Pertama (SMP)
      </h1>
      <p class="text-xl md:text-2xl mb-12 opacity-90">
        Pemantapan konsep dasar dan persiapan ujian dengan fokus pada pemahaman mendalam dan teknik belajar efektif.
      </p>
      <a href="{{ route('register.create') }}?level=smp" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300">
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
            <span class="text-white text-3xl">📖 Bahasa Indonesia</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Analisis teks, tata bahasa lanjutan, dan pengembangan keterampilan menulis esai. Fokus pada pemahaman konteks dan interpretasi makna.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🔢 Matematika</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Aljabar, geometri, statistika, dan trigonometri. Pembelajaran konsep-konsep abstrak dengan pendekatan visual dan aplikasi nyata.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🧪 IPA</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Fisika, kimia, dan biologi dengan eksperimen laboratorium virtual. Pemahaman konsep sains melalui praktikum dan analisis data.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🏛️ IPS</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Sejarah Indonesia dan dunia, geografi, ekonomi, dan sosiologi. Pembelajaran melalui studi kasus dan diskusi kritis.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">🌐 Bahasa Inggris</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Grammar lanjutan, vocabulary building, reading comprehension, dan speaking skills. Persiapan untuk komunikasi global.
          </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-lg">
          <div class="bg-blue-600 p-4 rounded-full w-fit mb-6">
            <span class="text-white text-3xl">📊 Informatika</span>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Pengajaran cara berpikir logis dan kreatif untuk memecahkan masalah menggunakan teknologi digital.
          </p>
        </div>
      </div>

  </section>

  <section class="cta bg-blue-600 py-16 px-4">
    <div class="max-w-4xl mx-auto text-center text-white">
      <h2 class="text-3xl font-light mb-6">Siap Menghadapi Tantangan SMP?</h2>
      <p class="text-xl mb-8 opacity-90">Bergabunglah dengan siswa SMP yang telah berhasil meraih prestasi terbaik</p>
      <a href="{{ route('register.create') }}?level=smp" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300">
        Daftar Sekarang
      </a>
    </div>
  </section>
@endsection
