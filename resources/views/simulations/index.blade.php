<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Simulasi Deposito Bank') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-lg p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Simulasi Deposito</h1>
                        <p class="text-blue-100">Bandingkan suku bunga dari berbagai bank dan temukan yang terbaik untuk Anda</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pilih Bank -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Pilih Bank</h2>
                <p class="text-gray-600 mb-6">Klik salah satu bank untuk memulai simulasi</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($banks as $bank)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer border-2 border-transparent hover:border-blue-500"
                         onclick="document.getElementById('form-bank-{{ $bank->bank_id }}').submit()">
                        <div class="p-6">
                            <div class="flex items-center mb-6">
                                <x-bank-icon :bank="$bank" size="lg" />
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $bank->nama_bank }}</h3>
                                    <p class="text-sm text-gray-500">Perbankan Terpercaya</p>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-1">Suku Bunga per Tahun</p>
                                <p class="text-4xl font-bold text-blue-600">{{ number_format($bank->suku_bunga_dasar, 2) }}%</p>
                            </div>
                            
                            <form action="{{ route('simulations.calculate') }}" method="POST" id="form-bank-{{ $bank->bank_id }}">
                                @csrf
                                <input type="hidden" name="bank_id" value="{{ $bank->bank_id }}">
                                <input type="hidden" name="nominal_deposito" value="10000000">
                                <input type="hidden" name="jangka_waktu_bulan" value="12">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                    Pilih Bank Ini
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            
        </div>
    </div>
</x-app-layout>