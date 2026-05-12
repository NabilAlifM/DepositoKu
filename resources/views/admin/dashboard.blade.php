@extends('layouts.admin')

@section('header', 'Dashboard Admin')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Total Pengguna -->
    <a href="{{ route('admin.users.index') }}"
       class="group block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
              transition-all duration-300
              hover:bg-blue-50 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-200 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm group-hover:text-blue-700 transition">
                    Total Pengguna
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ number_format($stats['total_users']) }}
                </p>
            </div>
        </div>
    </a>

    <!-- Card 2: Total Bank -->
    <a href="{{ route('admin.banks.index') }}"
       class="group block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
              transition-all duration-300
              hover:bg-green-50 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 group-hover:bg-green-200 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm group-hover:text-green-700 transition">
                    Total Bank
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ number_format($stats['total_banks']) }}
                </p>
            </div>
        </div>
    </a>

    <!-- Card 3: Total Simulasi -->
    <a href="{{ route('admin.simulations.index') }}"
       class="group block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
              transition-all duration-300
              hover:bg-yellow-50 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm group-hover:text-yellow-700 transition">
                    Total Simulasi
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ number_format($stats['total_simulations']) }}
                </p>
            </div>
        </div>
    </a>

    <!-- Card 4: Total Nominal -->
    <a href="{{ route('admin.simulations.index') }}"
       class="group block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
              transition-all duration-300
              hover:bg-purple-50 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600 group-hover:bg-purple-200 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm group-hover:text-purple-700 transition">
                    Total Nominal
                </p>
                <p class="text-lg font-bold text-gray-800">
                    Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}
                </p>
            </div>
        </div>
    </a>
</div>

<!-- Bank Populer & Grafik -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Bank Populer -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Bank Paling Populer</h3>
        </div>
        <div class="p-6">
            @forelse($popularBanks as $item)
                <div class="flex items-center justify-between py-3 border-b last:border-b-0">
                    <div class="flex items-center">
                        @if($item->bank->logo_url)
                            <img src="{{ asset($item->bank->logo_url) }}" alt="{{ $item->bank->nama_bank }}" class="w-10 h-10 rounded object-contain">
                        @else
                            <div class="w-10 h-10 rounded bg-gray-200 flex items-center justify-center">
                                <span class="text-xs font-bold text-gray-600">{{ substr($item->bank->nama_bank, 0, 2) }}</span>
                            </div>
                        @endif
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">{{ $item->bank->nama_bank }}</p>
                            <p class="text-sm text-gray-500">{{ $item->bank->suku_bunga_dasar }}% p.a.</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-600">{{ number_format($item->total) }}</p>
                        <p class="text-xs text-gray-500">simulasi</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">Belum ada data simulasi</p>
            @endforelse
        </div>
    </div>

    <!-- Grafik Bulanan -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Simulasi Per Bulan (12 Bulan Terakhir)</h3>
        </div>
        <div class="p-6">
            @forelse($monthlySimulations as $item)
                <div class="flex items-center justify-between py-2">
                    <p class="text-sm text-gray-600 w-24">{{ \Carbon\Carbon::parse($item->month . '-01')->format('M Y') }}</p>
                    <div class="flex-1 mx-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 rounded-full h-2 transition-all duration-300" 
                                 style="width: {{ $monthlySimulations->max('total') > 0 ? ($item->total / $monthlySimulations->max('total')) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 w-16 text-right">{{ number_format($item->total) }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">Belum ada data</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Recent Simulations -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Simulasi Terbaru</h3>
        <a href="{{ route('admin.simulations.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium transition">
            Lihat Semua →
        </a>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jangka Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bunga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentSimulations as $sim)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $sim->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $sim->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($sim->bank->logo_url)
                                        <img src="{{ asset($sim->bank->logo_url) }}" alt="{{ $sim->bank->nama_bank }}" class="w-8 h-8 rounded object-contain mr-2">
                                    @endif
                                    <span class="text-sm text-gray-900">{{ $sim->bank->nama_bank }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                Rp {{ number_format($sim->nominal_deposito, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $sim->jangka_waktu_bulan }} bulan
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">
                                Rp {{ number_format($sim->bunga_diterima, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $sim->waktu_simulasi->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-medium">Belum ada simulasi</p>
                                    <p class="text-sm mt-1">Simulasi yang dibuat pengguna akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection