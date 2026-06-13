@extends('layouts.home_layout')

@section('content')
  <section class="hero bg-blue-800 text-white py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-5xl md:text-6xl font-light mb-6">
        Tentang Study Buddy
      </h1>
      <p class="text-xl md:text-2xl mb-12 opacity-90">
        Platform bimbingan belajar online terpercaya yang berkomitmen mencetak generasi juara melalui pendidikan berkualitas.
      </p>
    </div>
  </section>

  <section class="vision-mission bg-white py-24 px-4">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <div class="text-center">
          <div class="bg-blue-600 p-6 rounded-full mx-auto mb-8 w-fit">
            <span class="text-white text-6xl">🎯</span>
          </div>
          <h2 class="text-4xl font-light text-blue-900 mb-8">Visi</h2>
          <p class="text-lg text-gray-600 leading-relaxed">
            Menjadi platform bimbingan belajar online terdepan di Indonesia yang mampu mencetak generasi muda yang unggul dalam akademik, berkarakter kuat, dan siap menghadapi tantangan global melalui pendidikan yang inovatif dan berkualitas tinggi.
          </p>
        </div>

        <div class="text-center">
          <div class="bg-blue-600 p-6 rounded-full mx-auto mb-8 w-fit">
            <span class="text-white text-6xl">🚀</span>
          </div>
          <h2 class="text-4xl font-light text-blue-900 mb-8">Misi</h2>
          <ul class="text-lg text-gray-600 text-left space-y-4">
            <li class="flex items-start">
              <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-4 mt-1">1</span>
              <span>Menyediakan layanan bimbingan belajar yang mudah diakses dan terjangkau untuk semua kalangan siswa</span>
            </li>
            <li class="flex items-start">
              <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-4 mt-1">2</span>
              <span>Mengembangkan metode pembelajaran inovatif yang menarik dan efektif untuk meningkatkan prestasi akademik</span>
            </li>
            <li class="flex items-start">
              <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-4 mt-1">3</span>
              <span>Menghubungkan siswa dengan tutor-tutor berkualitas dan berpengalaman di bidangnya</span>
            </li>
            <li class="flex items-start">
              <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-4 mt-1">4</span>
              <span>Mendorong pengembangan karakter dan soft skills siswa melalui program pembelajaran holistik</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="why-choose-us bg-blue-50 py-24 px-4">
    <div class="max-w-6xl mx-auto text-center">
      <h2 class="text-4xl font-light text-blue-900 mb-16">Mengapa Memilih Study Buddy?</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="bg-blue-600 p-4 rounded-full mx-auto mb-6 w-fit">
            <span class="text-white text-3xl">👨‍🏫</span>
          </div>
          <h3 class="text-2xl font-medium text-blue-900 mb-4">Tutor Berkualitas</h3>
          <p class="text-gray-600">Tutor-tutor terpilih dengan pengalaman mengajar dan prestasi akademik yang terbukti</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="bg-blue-600 p-4 rounded-full mx-auto mb-6 w-fit">
            <span class="text-white text-3xl">💡</span>
          </div>
          <h3 class="text-2xl font-medium text-blue-900 mb-4">Metode Inovatif</h3>
          <p class="text-gray-600">Pendekatan pembelajaran modern dengan teknologi terkini untuk hasil maksimal</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="bg-blue-600 p-4 rounded-full mx-auto mb-6 w-fit">
            <span class="text-white text-3xl">🏆</span>
          </div>
          <h3 class="text-2xl font-medium text-blue-900 mb-4">Prestasi Terbukti</h3>
          <p class="text-gray-600">Ribuan siswa telah berhasil mencapai target akademik mereka bersama Study Buddy</p>
        </div>
      </div>
    </div>
  </section>
@endsection
