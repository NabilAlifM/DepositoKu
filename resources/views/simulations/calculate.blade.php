<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Simulasi Deposito') }} - {{ $result['bank']->nama_bank }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Bank Info Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-lg p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <x-bank-icon :bank="$result['bank']" size="xl" />
                        <div class="ml-6">
                            <h1 class="text-3xl font-bold mb-2">{{ $result['bank']->nama_bank }}</h1>
                            <p class="text-blue-100 mb-4">Suku Bunga: {{ number_format($result['bank']->suku_bunga_dasar, 2) }}% per tahun</p>
                            <a href="{{ route('simulations.index') }}" class="inline-flex items-center text-white hover:text-blue-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Ganti Bank
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Input -->
            <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Simulasi Deposito</h2>
                
                <form action="{{ route('simulations.calculate') }}" method="POST" id="simulationForm">
                    @csrf
                    <input type="hidden" name="bank_id" value="{{ $result['bank']->bank_id }}">
                    
                    <!-- Jumlah Deposito -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Jumlah Deposito</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-gray-500 font-semibold">Rp</span>
                            <input type="text" 
                                   id="nominalInput"
                                   name="nominal_deposito_display"
                                   value="{{ number_format($result['nominal'], 0, ',', '.') }}"
                                   class="w-full pl-12 pr-4 py-3 text-xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                   placeholder="10.000.000"
                                   oninput="formatRupiah(this); updateSlider();">
                            <input type="hidden" id="nominalHidden" name="nominal_deposito" value="{{ $result['nominal'] }}">
                        </div>
                        <input type="range" 
                               id="nominalSlider"
                               min="1000000" 
                               max="1000000000" 
                               step="1000000" 
                               value="{{ $result['nominal'] }}"
                               class="w-full mt-4 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                               oninput="updateInput(this.value)">
                        <div class="flex justify-between text-sm text-gray-500 mt-2">
                            <span>Rp 1 jt</span>
                            <span>Rp 1 M</span>
                        </div>
                    </div>

                    <!-- Jangka Waktu -->
                    <div class="mb-8">
                        <label class="block text-gray-700 font-semibold mb-2">Jangka Waktu</label>
                        <select name="jangka_waktu_bulan" 
                                class="w-full px-4 py-3 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                            <option value="1" {{ $result['jangka_waktu'] == 1 ? 'selected' : '' }}>1 Bulan</option>
                            <option value="3" {{ $result['jangka_waktu'] == 3 ? 'selected' : '' }}>3 Bulan</option>
                            <option value="6" {{ $result['jangka_waktu'] == 6 ? 'selected' : '' }}>6 Bulan</option>
                            <option value="12" {{ $result['jangka_waktu'] == 12 ? 'selected' : '' }}>1 Tahun</option>
                            <option value="24" {{ $result['jangka_waktu'] == 24 ? 'selected' : '' }}>2 Tahun</option>
                            <option value="36" {{ $result['jangka_waktu'] == 36 ? 'selected' : '' }}>3 Tahun</option>
                            <option value="60" {{ $result['jangka_waktu'] == 60 ? 'selected' : '' }}>5 Tahun</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Hitung Ulang
                    </button>
                </form>
            </div>

            <!-- Hasil Simulasi -->
            <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Hasil Simulasi</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 bg-blue-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Dana Awal</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($result['nominal'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="p-6 bg-green-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Bunga Kotor</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($result['bunga_kotor'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="p-6 bg-red-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Pajak (20%)</p>
                        <p class="text-2xl font-bold text-red-600">Rp {{ number_format($result['pajak'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="p-6 bg-green-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Keuntungan Bersih</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($result['bunga_bersih'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="mt-6 p-8 bg-gradient-to-r from-green-500 to-green-700 rounded-xl text-white">
                    <p class="text-lg mb-2">Total Akhir (Setelah Pajak)</p>
                    <p class="text-4xl font-bold">Rp {{ number_format($result['total_akhir'], 0, ',', '.') }}</p>
                    <p class="text-green-100 mt-2">untuk {{ $result['jangka_waktu'] }} bulan</p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-4">
                    <form action="{{ route('simulations.store') }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="bank_id" value="{{ $result['bank']->bank_id }}">
                        <input type="hidden" name="nominal_deposito" value="{{ $result['nominal'] }}">
                        <input type="hidden" name="jangka_waktu_bulan" value="{{ $result['jangka_waktu'] }}">
                        <input type="hidden" name="bunga_diterima" value="{{ $result['bunga_bersih'] }}">
                        <input type="hidden" name="total_akhir" value="{{ $result['total_akhir'] }}">
                        
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Simpan Hasil
                        </button>
                    </form>
                    
                    <button onclick="document.getElementById('compareModal').classList.remove('hidden')"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Bandingkan Bank
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bandingkan -->
    <div id="compareModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-xl bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold text-gray-800">Pilih Bank untuk Dibandingkan</h3>
                <button onclick="document.getElementById('compareModal').classList.add('hidden')" 
                        class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('simulations.compare') }}" method="POST">
                @csrf
                <input type="hidden" name="nominal_deposito" value="{{ $result['nominal'] }}">
                <input type="hidden" name="jangka_waktu_bulan" value="{{ $result['jangka_waktu'] }}">
                <input type="hidden" name="bank_ids[]" value="{{ $result['bank']->bank_id }}">
                
                <p class="text-gray-600 mb-4">Pilih maksimal 2 bank lainnya untuk dibandingkan dengan <strong>{{ $result['bank']->nama_bank }}</strong></p>
                
                <div class="space-y-3 mb-6">
                    @foreach($banks as $bank)
                        @if($bank->bank_id != $result['bank']->bank_id)
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 cursor-pointer transition">
                            <input type="checkbox" name="bank_ids[]" value="{{ $bank->bank_id }}" 
                                   class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500 mr-4    "
                                   onchange="limitCheckboxes(this)">
                            <x-bank-icon :bank="$bank" size="sm" class="m-10" />
                            <div class="ml-4 flex-1 flex justify-between items-center">
                                <span class="font-semibold text-gray-800">{{ $bank->nama_bank }}</span>
                                <span class="text-bl    ue-600 font-bold">{{ number_format($bank->suku_bunga_dasar, 2) }}%</span>
                            </div>
                        </label>
                        @endif
                    @endforeach
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition">
                    Bandingkan Sekarang
                </button>
            </form>
        </div>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/\D/g, '');
            let formatted = new Intl.NumberFormat('id-ID').format(value);
            input.value = formatted;
            document.getElementById('nominalHidden').value = value;
        }

        function updateSlider() {
            let value = document.getElementById('nominalHidden').value;
            document.getElementById('nominalSlider').value = value;
        }

        function updateInput(value) {
            let formatted = new Intl.NumberFormat('id-ID').format(value);
            document.getElementById('nominalInput').value = formatted;
            document.getElementById('nominalHidden').value = value;
        }

        function limitCheckboxes(checkbox) {
            const checkboxes = document.querySelectorAll('input[name="bank_ids[]"][type="checkbox"]');
            const checked = Array.from(checkboxes).filter(cb => cb.checked);
            
            if (checked.length > 2) {
                checkbox.checked = false;
                alert('Maksimal 2 bank tambahan yang bisa dipilih');
            }
        }
    </script>
</x-app-layout>