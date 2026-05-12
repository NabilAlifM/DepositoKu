@extends('layouts.admin')

@section('header', 'Detail Simulasi #' . $simulation->simulasi_id)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.simulations.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Riwayat
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-white">
            <h2 class="text-2xl font-bold">Detail Simulasi Deposito</h2>
            <p class="text-blue-100 mt-1">ID: #{{ $simulation->simulasi_id }}</p>
        </div>

        <div class="p-6 space-y-6">
            <!-- Info Pengguna -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b">Informasi Pengguna</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="text-gray-900 font-medium">{{ $simulation->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-gray-900 font-medium">{{ $simulation->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Info Bank -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b">Informasi Bank</h3>
                <div class="flex items-start gap-4">
                    @if($simulation->bank->logo_url)
                        <img src="{{ asset($simulation->bank->logo_url) }}" 
                             alt="{{ $simulation->bank->nama_bank }}" 
                             class="w-20 h-20 rounded object-contain border p-2">
                    @endif
                    <div class="flex-1">
                        <h4 class="font-bold text-xl text-gray-900">{{ $simulation->bank->nama_bank }}</h4>
                        @if($simulation->bank->pt)
                            <p class="text-sm text-gray-600 mt-1">{{ $simulation->bank->pt }}</p>
                        @endif
                        <div class="mt-3">
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">
                                Suku Bunga: {{ $simulation->bank->suku_bunga_dasar }}% p.a.
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Simulasi -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b">Detail Simulasi</h3>
                <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-600">Nominal Deposito</span>
                        <span class="text-xl font-bold text-gray-900">
                            Rp {{ number_format($simulation->nominal_deposito, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-600">Jangka Waktu</span>
                        <span class="text-xl font-bold text-gray-900">
                            {{ $simulation->jangka_waktu_bulan }} Bulan
                        </span>
                    </div>

                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-600">Suku Bunga</span>
                        <span class="text-xl font-bold text-green-600">
                            {{ $simulation->bank->suku_bunga_dasar }}% per tahun
                        </span>
                    </div>

                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-600">Bunga yang Diterima</span>
                        <span class="text-xl font-bold text-green-600">
                            Rp {{ number_format($simulation->bunga_diterima, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center pt-4 bg-blue-50 -mx-6 -mb-6 px-6 py-4 rounded-b-lg">
                        <span class="text-lg font-semibold text-gray-800">Total Akhir</span>
                        <span class="text-2xl font-bold text-blue-600">
                            Rp {{ number_format($simulation->total_akhir, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Rumus Perhitungan -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b">Rumus Perhitungan</h3>
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded">
                    <p class="text-sm text-gray-700 mb-2">
                        <strong>Bunga = (Nominal × Suku Bunga × Jangka Waktu) / (12 × 100)</strong>
                    </p>
                    <p class="text-sm text-gray-600">
                        = ({{ number_format($simulation->nominal_deposito, 0, ',', '.') }} × {{ $simulation->bank->suku_bunga_dasar }} × {{ $simulation->jangka_waktu_bulan }}) / (12 × 100)
                    </p>
                    <p class="text-sm text-gray-600">
                        = Rp {{ number_format($simulation->bunga_diterima, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Info Waktu -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b">Informasi Waktu</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Waktu Simulasi</p>
                        <p class="text-gray-900 font-medium">
                            {{ $simulation->waktu_simulasi->format('d F Y, H:i:s') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Relatif</p>
                        <p class="text-gray-900 font-medium">
                            {{ $simulation->waktu_simulasi->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4 border-t">
                <a href="{{ route('admin.simulations.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition">
                    Kembali
                </a>
                <form action="{{ route('admin.simulations.destroy', $simulation->simulasi_id) }}" 
                      method="POST" 
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition"
                            onclick="return confirm('Yakin ingin menghapus riwayat simulasi ini?')">
                        Hapus Simulasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection