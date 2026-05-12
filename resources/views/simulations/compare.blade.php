<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perbandingan Multi-Bank') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Perbandingan Multi-Bank</h1>
                        <p class="text-gray-600">Nominal: <strong>Rp {{ number_format($nominal, 0, ',', '.') }}</strong> | Tenor: <strong>{{ $jangkaWaktu }} bulan</strong></p>
                    </div>
                    <a href="{{ route('simulations.index') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Simulasi Baru
                    </a>
                </div>
            </div>

            <!-- Label TERBAIK -->
            @if(count($results) > 0)
            <div class="flex items-center justify-center mb-4">
                <span class="bg-yellow-400 text-yellow-900 px-6 py-2 rounded-full font-bold text-lg shadow-md">
                    ⭐ TERBAIK
                </span>
            </div>
            @endif

            <!-- Cards Perbandingan -->
            <div class="grid grid-cols-1 md:grid-cols-{{ min(count($results), 3) }} gap-6 mb-8">
                @foreach($results as $index => $result)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden {{ $index === 0 ? 'ring-4 ring-yellow-400' : '' }}">
                    <!-- Header Bank -->
                    <div class="bg-gradient-to-r {{ $index === 0 ? 'from-yellow-500 to-yellow-600' : 'from-blue-500 to-blue-600' }} p-6 text-white">
                        <div class="flex items-center justify-center mb-4">
                            <x-bank-icon :bank="$result['bank']" size="lg" />
                        </div>
                        <h3 class="text-2xl font-bold text-center">{{ $result['bank']->nama_bank }}</h3>
                        <p class="text-center text-sm opacity-90 mt-2">{{ number_format($result['bank']->suku_bunga_dasar, 2) }}% per tahun</p>
                    </div>

                    <!-- Detail -->
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b">
                            <span class="text-gray-600">Dana Awal</span>
                            <span class="font-bold text-gray-800">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b">
                            <span class="text-gray-600">Bunga Kotor</span>
                            <span class="font-bold text-green-600">Rp {{ number_format($result['bunga_kotor'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b">
                            <span class="text-gray-600">Pajak 20%</span>
                            <span class="font-bold text-red-600">Rp {{ number_format($result['pajak'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b">
                            <span class="text-gray-600">Keuntungan Bersih</span>
                            <span class="font-bold text-green-600">Rp {{ number_format($result['bunga_bersih'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b">
                            <span class="text-gray-600">Jangka Waktu</span>
                            <span class="font-bold text-gray-800">{{ $jangkaWaktu }} Bulan</span>
                        </div>

                        <!-- Total Akhir -->
                        <div class="bg-gradient-to-r {{ $index === 0 ? 'from-yellow-50 to-yellow-100' : 'from-blue-50 to-blue-100' }} p-4 rounded-lg mt-4">
                            <p class="text-sm text-gray-600 text-center mb-1">Total Akhir (Setelah Pajak)</p>
                            <p class="text-2xl font-bold text-center {{ $index === 0 ? 'text-yellow-700' : 'text-blue-700' }}">
                                Rp {{ number_format($result['total_akhir'], 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Action Button -->
                        <form action="{{ route('simulations.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="bank_id" value="{{ $result['bank']->bank_id }}">
                            <input type="hidden" name="nominal_deposito" value="{{ $nominal }}">
                            <input type="hidden" name="jangka_waktu_bulan" value="{{ $jangkaWaktu }}">
                            <input type="hidden" name="bunga_diterima" value="{{ $result['bunga_bersih'] }}">
                            <input type="hidden" name="total_akhir" value="{{ $result['total_akhir'] }}">
                            
                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Simpan Hasil Ini
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Chart Visualization -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Visualisasi Perbandingan</h2>
                
                <div class="relative h-96">
                    <canvas id="comparisonChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('comparisonChart').getContext('2d');
        
        const data = {
            labels: {!! json_encode(array_map(function($r) { return $r['bank']->nama_bank; }, $results)) !!},
            datasets: [
                {
                    label: 'Dana Awal',
                    data: Array({{ count($results) }}).fill({{ $nominal }}),
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Keuntungan Bersih',
                    data: {!! json_encode(array_map(function($r) { return $r['bunga_bersih']; }, $results)) !!},
                    backgroundColor: 'rgba(34, 197, 94, 0.7)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 2
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Perbandingan Dana Awal vs Keuntungan Bersih',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID', {
                                    notation: 'compact',
                                    compactDisplay: 'short'
                                }).format(value);
                            }
                        }
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>
</x-app-layout>