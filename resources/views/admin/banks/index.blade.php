@extends('layouts.admin')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Kelola Bank') }}
    </h2>
    <a href="{{ route('admin.banks.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
        + Tambah Bank
    </a>
</div>
@endsection

@section('content')
<!-- Filter/Search Section -->
<div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Cari & Filter Bank</h3>
    
    <form method="GET" action="{{ route('admin.banks.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Search by Name/PT -->
        <div class="lg:col-span-2">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Bank / PT</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       id="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari bank..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <!-- Filter Suku Bunga Min -->
        <div>
            <label for="bunga_min" class="block text-sm font-medium text-gray-700 mb-2">Bunga Min (%)</label>
            <input type="number" 
                   name="bunga_min" 
                   id="bunga_min" 
                   value="{{ request('bunga_min') }}"
                   step="0.01"
                   min="0"
                   placeholder="0.00"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <!-- Filter Suku Bunga Max -->
        <div>
            <label for="bunga_max" class="block text-sm font-medium text-gray-700 mb-2">Bunga Max (%)</label>
            <input type="number" 
                   name="bunga_max" 
                   id="bunga_max" 
                   value="{{ request('bunga_max') }}"
                   step="0.01"
                   min="0"
                   placeholder="10.00"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <!-- Buttons -->
        <div class="lg:col-span-4 flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            <a href="{{ route('admin.banks.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Table Section -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Bank</h3>
                <p class="text-sm text-gray-600 mt-1">
                    @if(request('search') || request('bunga_min') || request('bunga_max'))
                        Menampilkan {{ $banks->total() }} bank dari hasil pencarian
                    @else
                        Total: {{ $banks->total() }} bank
                    @endif
                </p>
            </div>
            @if(request('search') || request('bunga_min') || request('bunga_max'))
                <div class="text-sm">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter Aktif
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PT</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Suku Bunga</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($banks as $bank)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($bank->logo_url)
                                        <img src="{{ asset($bank->logo_url) }}" 
                                             alt="{{ $bank->nama_bank }}" 
                                             class="w-16 h-16 object-contain rounded mr-3 border border-gray-200 p-1">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                            <span class="text-sm font-bold text-gray-600">{{ substr($bank->nama_bank, 0, 3) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $bank->nama_bank }}</p>
                                        <p class="text-xs text-gray-500 mt-1">ID: {{ $bank->bank_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $bank->pt ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $bank->suku_bunga_dasar }}% p.a.
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.banks.edit', $bank->bank_id) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.banks.destroy', $bank->bank_id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus {{ $bank->nama_bank }}? Data ini tidak dapat dikembalikan!')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    @if(request('search') || request('bunga_min') || request('bunga_max'))
                                        <p class="font-medium text-gray-900 mb-1">Tidak ada bank yang sesuai dengan pencarian</p>
                                        <p class="text-sm text-gray-500">Coba ubah kriteria pencarian Anda</p>
                                        <a href="{{ route('admin.banks.index') }}" class="mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            Reset Filter
                                        </a>
                                    @else
                                        <p class="font-medium text-gray-900 mb-1">Belum ada data bank</p>
                                        <p class="text-sm text-gray-500 mb-3">Mulai tambahkan bank pertama Anda</p>
                                        <a href="{{ route('admin.banks.create') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Bank Pertama
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($banks->hasPages())
            <div class="mt-6 flex items-center justify-between border-t border-gray-200 pt-4">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if($banks->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $banks->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                    @endif

                    @if($banks->hasMorePages())
                        <a href="{{ $banks->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium">{{ $banks->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-medium">{{ $banks->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-medium">{{ $banks->total() }}</span>
                            bank
                        </p>
                    </div>
                    <div>
                        {{ $banks->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection