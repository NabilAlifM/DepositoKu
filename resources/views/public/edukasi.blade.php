<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi Deposito - DepositoKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-800">DepositoKu</span>
                    </a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="/" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium">Home</a>
                        <a href="{{ route('database.bank') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium">Database Bank</a>
                        <a href="{{ route('edukasi') }}" class="text-blue-600 px-3 py-2 font-medium border-b-2 border-blue-600">Edukasi</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('simulations.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Simulasi</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Edukasi Deposito</h1>
            <p class="text-xl text-gray-600">Tingkatkan pemahaman Anda tentang deposito dengan panduan dan artikel kami</p>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            @foreach($articles as $article)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $article['image'] }}" 
                         alt="{{ $article['title'] }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $article['category'] }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        @if($article['icon'] == 'book')
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        @elseif($article['icon'] == 'chart')
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                        @elseif($article['icon'] == 'shield')
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        @else
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        @endif
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                        {{ $article['title'] }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ $article['description'] }}
                    </p>
                    <a href="#" class="text-blue-600 font-semibold text-sm inline-flex items-center group-hover:underline">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Masih Ada Pertanyaan?</h2>
            <p class="text-xl text-blue-100 mb-8">Tim kami siap membantu Anda memahami deposito lebih dalam</p>
            <a href="#" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition">
                Hubungi Kami
            </a>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</body>
</html>