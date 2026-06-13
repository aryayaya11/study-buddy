@extends('layouts.home_layout')

@section('content')
<section class="hero bg-blue-800 text-white py-32 px-4">
<div class="max-w-4xl mx-auto text-center">
      <h1 class="text-5xl md:text-6xl font-light mb-6">
        Hubungi Kami
      </h1>
      <p class="text-xl md:text-2xl mb-12 opacity-90">
        Siap memulai perjalanan belajar Anda? Konsultasikan kebutuhan belajar Anda dengan tim kami.
      </p>
      
  </section>

  <section class="contact-main bg-white py-24 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Contact Info -->
        <div class="contact-info space-y-8">
          <div>
            <h2 class="text-3xl font-light text-blue-900 mb-8">Informasi Kontak</h2>
            <p class="text-gray-600 leading-relaxed">
              Tim kami siap membantu Anda menemukan program belajar yang tepat. Hubungi kami melalui berbagai channel yang tersedia.
            </p>
          </div>

          <div class="space-y-6">
            <div class="flex items-start space-x-4">
              <div class="bg-blue-600 p-3 rounded-lg">
                <span class="text-white text-xl">📍</span>
              </div>
              <div>
                <h3 class="font-medium text-blue-900">Alamat</h3>
                <p class="text-gray-600">Jl. Pendidikan No. 123<br>Jakarta Pusat, DKI Jakarta 10230</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="bg-blue-600 p-3 rounded-lg">
                <span class="text-white text-xl">📱</span>
              </div>
              <div>
                <h3 class="font-medium text-blue-900">Telepon</h3>
                <p class="text-gray-600">+62 812 3456 7890</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="bg-blue-600 p-3 rounded-lg">
                <span class="text-white text-xl">📧</span>
              </div>
              <div>
                <h3 class="font-medium text-blue-900">Email</h3>
                <p class="text-gray-600">studybuddy@gmail.com</p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="bg-blue-600 p-3 rounded-lg">
                <span class="text-white text-xl">🕒</span>
              </div>
              <div>
                <h3 class="font-medium text-blue-900">Jam Operasional</h3>
                <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 15:00</p>
              </div>
            </div>
          </div>

          <div>
            <h3 class="font-medium text-blue-900 mb-4">Ikuti Kami</h3>
            <div class="flex space-x-4">
              <a href="https://wa.me/6281234567890" target="_blank"
                 class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-full transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-xl"
                 title="WhatsApp">
                <span class="text-xl">📱</span>
              </a>
              <a href="https://www.instagram.com/studybuddy.id" target="_blank"
                 class="bg-pink-500 hover:bg-pink-600 text-white p-4 rounded-full transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-xl"
                 title="Instagram">
                <span class="text-xl">📸</span>
              </a>
              <a href="https://www.facebook.com/studybuddy.id" target="_blank"
                 class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-xl"
                 title="Facebook">
                <span class="text-xl">📘</span>
              </a>
              <a href="https://www.youtube.com/@studybuddy.id" target="_blank"
                 class="bg-red-500 hover:bg-red-600 text-white p-4 rounded-full transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-xl"
                 title="YouTube">
                <span class="text-xl">📺</span>
              </a>
              <a href="https://www.tiktok.com/@studybuddy.id" target="_blank"
                 class="bg-black hover:bg-gray-800 text-white p-4 rounded-full transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-xl"
                 title="TikTok">
                <span class="text-xl">🎵</span>
              </a>
            </div>
          </div>
        </div>

        <!-- Quick Contact Options -->
        <div class="quick-contact space-y-6">
          <h2 class="text-3xl font-light text-blue-900 mb-8">Cara Menghubungi Kami</h2>

          <div class="grid grid-cols-1 gap-4">
            <a href="https://wa.me/6281234567890" target="_blank"
               class="flex items-center p-6 bg-green-50 border border-green-200 rounded-xl hover:bg-green-100 transition-colors duration-300 group">
              <div class="bg-green-500 p-4 rounded-full mr-4 group-hover:scale-110 transition-transform duration-300">
                <span class="text-white text-2xl">📱</span>
              </div>
              <div>
                <h3 class="font-medium text-green-900">WhatsApp</h3>
                <p class="text-green-700">Chat langsung dengan tim kami</p>
              </div>
            </a>

            <a href="tel:+6281234567890"
               class="flex items-center p-6 bg-blue-50 border border-blue-200 rounded-xl hover:bg-blue-100 transition-colors duration-300 group">
              <div class="bg-blue-500 p-4 rounded-full mr-4 group-hover:scale-110 transition-transform duration-300">
                <span class="text-white text-2xl">📞</span>
              </div>
              <div>
                <h3 class="font-medium text-blue-900">Telepon</h3>
                <p class="text-blue-700">Panggilan langsung</p>
              </div>
            </a>

            <a href="mailto:studybuddy@gmail.com"
               class="flex items-center p-6 bg-purple-50 border border-purple-200 rounded-xl hover:bg-purple-100 transition-colors duration-300 group">
              <div class="bg-purple-500 p-4 rounded-full mr-4 group-hover:scale-110 transition-transform duration-300">
                <span class="text-white text-2xl">✉️</span>
              </div>
              <div>
                <h3 class="font-medium text-purple-900">Email</h3>
                <p class="text-purple-700">Kirim email untuk informasi detail</p>
              </div>
            </a>
          </div>

          <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
            <div class="flex items-start">
              <div class="bg-yellow-500 p-2 rounded-full mr-4">
                <span class="text-white text-lg">⚡</span>
              </div>
              <div>
                <h3 class="font-medium text-yellow-900 mb-2">Konsultasi Gratis</h3>
                <p class="text-yellow-800 text-sm">
                  Dapatkan konsultasi gratis untuk menentukan program belajar yang sesuai dengan kebutuhan Anda.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta bg-blue-600 py-16 px-4">
    <div class="max-w-4xl mx-auto text-center text-white">
      <h2 class="text-3xl font-light mb-6">Siap Memulai?</h2>
      <p class="text-xl mb-8 opacity-90">Bergabunglah dengan ribuan siswa yang telah sukses bersama Study Buddy</p>
      <a href="{{ route('register.create') }}" class="bg-white text-blue-600 font-medium py-4 px-10 rounded-lg text-lg hover:bg-gray-100 transition-colors duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
        Daftar Sekarang
      </a>
    </div>
  </section>
@endsection
