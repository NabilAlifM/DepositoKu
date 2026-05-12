<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Simulasi Deposito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Simulasi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Nominal Deposito</p>
                            <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($nominal, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Jangka Waktu</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $jangkaWaktu }} Bulan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Perbandingan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Perbandingan 3 Bank</h3>
                    
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Bank</th>
                                    <th scope="col" class="px-6 py-3">Suku Bunga</th>
                                    <th scope="col" class="px-6 py-3">Bunga Diterima</th>
                                    <th scope="col" class="px-6 py-3">Total Akhir</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whi  tespace-nowrap">
                                        {{ $result['bank']->nama_bank }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            {{ number_format($result['bank']->suku_bunga_dasar, 2) }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">
                                        Rp {{ number_format($result['bunga_diterima'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-blue-600 font-bold">
                                        Rp {{ number_format($result['total_akhir'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('simulations.store') }}">
                                            @csrf
                                            <input type="hidden" name="bank_id" value="{{ $result['bank']->bank_id }}">
                                            <input type="hidden" name="nominal_deposito" value="{{ $nominal }}">
                                            <input type="hidden" name="jangka_waktu_bulan" value="{{ $jangkaWaktu }}">
                                            <input type="hidden" name="bunga_diterima" value="{{ $result['bunga_diterima'] }}">
                                            <input type="hidden" name="total_akhir" value="{{ $result['total_akhir'] }}">
                                            
                                            <button type="submit" 
                                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-2 focus:outline-none">
                                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                                </svg>
                                                Simpan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('simulations.index') }}" 
                           class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Simulasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>