<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DepositoKu - Platform Perbandingan Deposito Bank</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="relative min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="#home" class="flex items-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-800">DepositoKu</span>
                        </a>
                        
                        <!-- Navigation Menu -->
                        <div class="hidden md:flex ml-10 space-x-8">
                            <a href="#home" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium transition">Home</a>
                            <a href="#simulasi" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium transition">Simulasi</a>
                            <a href="#database" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium transition">Database Bank</a>
                            <a href="#edukasi" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium transition">Edukasi</a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('simulations.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Dashboard</a>
                        @else
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 font-medium">Login</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->

        
        <section id="home" class="bg-gradient-to-br from-blue-50 via-white to-blue-50 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl font-bold text-gray-900 mb-6">
                        Simulasi Deposito Bank
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Bandingkan hasil deposito dari berbagai bank dan temukan pilihan terbaik untuk investasi Anda
                    </p>
                    
                    @auth
                        <a href="{{ route('simulations.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            Mulai Simulasi
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            Daftar Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- Features -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Perbandingan Multi Bank</h3>
                        <p class="text-gray-600">Bandingkan hasil deposito dari berbagai bank dalam satu tampilan</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Perhitungan Akurat</h3>
                        <p class="text-gray-600">Sistem menghitung bunga deposito secara otomatis dengan rumus yang tepat</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Riwayat Simulasi</h3>
                        <p class="text-gray-600">Simpan dan lihat kembali riwayat simulasi deposito Anda</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Simulasi Section -->
           @php
                        $banks = \App\Models\Bank::all();
                    @endphp

        <!-- Database Bank Section -->
        <section id="database" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Database Suku Bunga Bank</h2>
                    <p class="text-gray-600">Perbandingan lengkap suku bunga deposito dari berbagai bank di Indonesia</p>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Bank</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Suku Bunga</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Minimum</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($banks as $bank)
                                <tr class="hover:bg-blue-50 transition cursor-pointer group" 
                                    onclick="handleBankClick({{ $bank->bank_id }}, {{ auth()->check() ? 'true' : 'false' }})">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <x-bank-icon :bank="$bank" size="sm" />
                                            <div class="ml-3">
                                                <p class="font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $bank->nama_bank }}</p>
                                                <p class="text-xs text-gray-500">Klik untuk simulasi →</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold text-green-700 bg-green-100">
                                            {{ number_format($bank->suku_bunga_dasar, 2) }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-700 text-sm">
                                        Rp 1.000.000
                                    </td>
                                    <td class="px-6 py-4 text-center" onclick="event.stopPropagation()">
                                        @auth
                                            <form action="{{ route('simulations.calculate') }}" method="POST" class="inline-block" id="form-bank-{{ $bank->bank_id }}">
                                                @csrf
                                                <input type="hidden" name="bank_id" value="{{ $bank->bank_id }}">
                                                <input type="hidden" name="nominal_deposito" value="10000000">
                                                <input type="hidden" name="jangka_waktu_bulan" value="12">
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                                    Simulasi
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login', ['bank_id' => $bank->bank_id]) }}" 
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition inline-block">
                                                Login & Simulasi
                                            </a>
                                        @endauth
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 border-t flex items-center justify-between">
                        <p class="text-sm text-gray-600">
                            Terakhir diperbarui: <strong>{{ now()->format('d F Y') }}</strong>
                        </p>
                        <p class="text-sm text-gray-500">
                            * Suku bunga dapat berubah sewaktu-waktu
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Edukasi Section -->
        <!-- Edukasi Section -->
        <section id="edukasi" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Edukasi Deposito</h2>
                    <p class="text-gray-600">Tingkatkan pemahaman Anda tentang deposito dengan panduan dan artikel kami</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Article 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400&h=300&fit=crop" 
                                 alt="Panduan Dasar Deposito" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4">
                                <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    Panduan Dasar
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                Apa itu Deposito dan Bagaimana Cara Kerjanya?
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Pelajari dasar-dasar deposito, mulai dari pengertian, jenis-jenis, hingga keuntungan yang bisa Anda dapatkan dari investasi deposito.
                            </p>
                            <a href="#" class="text-blue-600 font-semibold text-sm inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Article 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400&h=300&fit=crop" 
                                 alt="Strategi Deposito" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4">
                                <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    Tips & Trik
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                Strategi Memaksimalkan Keuntungan Deposito
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Temukan strategi terbaik untuk memaksimalkan return dari deposito Anda, termasuk pemilihan tenor dan bank yang tepat.
                            </p>
                            <a href="#" class="text-blue-600 font-semibold text-sm inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Article 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=300&fit=crop" 
                                 alt="Perbandingan Investasi" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4">
                                <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    Perbandingan
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                Deposito vs Investasi Lain: Mana yang Lebih Baik?
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Bandingkan deposito dengan instrumen investasi lainnya seperti saham, reksadana, dan obligasi untuk menentukan pilihan terbaik.
                            </p>
                            <a href="#" class="text-blue-600 font-semibold text-sm inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Article 4 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=400&h=300&fit=crop" 
                                 alt="Pajak dan Biaya Deposito" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute top-4 left-4">
                                <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    Regulasi
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                Memahami Pajak dan Biaya Deposito
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Pahami perhitungan pajak deposito dan biaya-biaya lain yang perlu Anda ketahui sebelum membuka deposito.
                            </p>
                            <a href="#" class="text-blue-600 font-semibold text-sm inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        @guest
        <section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Siap Memulai Investasi Deposito?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Daftar sekarang dan bandingkan suku bunga dari berbagai bank untuk mendapatkan return terbaik
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg">
                    Daftar Gratis Sekarang
                </a>
            </div>
        </section>
        @endguest

        <!-- Footer -->
        <x-footer />
    </div>

    <!-- Smooth Scroll Script -->
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Handle bank click
        function handleBankClick(bankId, isAuthenticated) {
            if (isAuthenticated) {
                // Submit form jika sudah login
                document.getElementById('form-bank-' + bankId).submit();
            } else {
                // Redirect ke login dengan bank_id
                window.location.href = '{{ route("login") }}?bank_id=' + bankId;
            }
        }
    </script>
</body>
</html>