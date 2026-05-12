@extends('layouts.admin')

@section('header', 'Riwayat Simulasi')

@section('content')
<!-- Filter Section -->
<div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter</h3>
    
    <form method="GET" action="{{ route('admin.simulations.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Filter Bank -->
        <div>
            <label for="bank_id" class="block text-sm font-medium text-gray-700 mb-2">Bank</label>
            <select name="bank_id" id="bank_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Bank</option>
                @foreach($banks as $bank)
                    <option value="{{ $bank->bank_id }}" {{ request('bank_id') == $bank->bank_id ? 'selected' : '' }}>
                        {{ $bank->nama_bank }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter User -->
        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Pengguna</label>
            <select name="user_id" id="user_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Pengguna</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Tanggal Dari -->
        <div>
            <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
            <input type="date" 
                   name="date_from" 
                   id="date_from" 
                   value="{{ request('date_from') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Filter Tanggal Sampai -->
        <div>
            <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
            <input type="date" 
                   name="date_to" 
                   id="date_to" 
                   value="{{ request('date_to') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Buttons -->
        <div class="lg:col-span-4 flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                Terapkan Filter
            </button>
            <a href="{{ route('admin.simulations.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
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
                <h3 class="text-lg font-semibold text-gray-800">Semua Riwayat Simulasi</h3>
                <p class="text-sm text-gray-600 mt-1">Total: {{ $simulations->total() }} simulasi</p>
            </div>
            <div class="text-sm text-gray-600">
                <span class="font-medium">Total Nominal:</span> 
                Rp {{ number_format($simulations->sum('nominal_deposito'), 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jangka Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bunga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Akhir</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($simulations as $simulation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $simulation->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $simulation->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($simulation->bank->logo_url)
                                        <img src="{{ asset($simulation->bank->logo_url) }}" 
                                             alt="{{ $simulation->bank->nama_bank }}" 
                                             class="w-8 h-8 rounded object-contain mr-2">
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $simulation->bank->nama_bank }}</p>
                                        <p class="text-sm text-gray-500">{{ $simulation->bank->suku_bunga_dasar }}% p.a.</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                Rp {{ number_format($simulation->nominal_deposito, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800">
                                    {{ $simulation->jangka_waktu_bulan }} bulan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-green-600">
                                Rp {{ number_format($simulation->bunga_diterima, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-blue-600">
                                Rp {{ number_format($simulation->total_akhir, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                {{ $simulation->waktu_simulasi->format('d M Y') }}
                                <span class="block text-xs">{{ $simulation->waktu_simulasi->diffForHumans() }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.simulations.show', $simulation->simulasi_id) }}" 
                                   class="text-blue-600 hover:text-blue-800 mr-3">Detail</a>
                                <form action="{{ route('admin.simulations.destroy', $simulation->simulasi_id) }}" 
                                      method="POST" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800" 
                                            onclick="return confirm('Yakin ingin menghapus riwayat simulasi ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data simulasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $simulations->links() }}
        </div>
    </div>
</div>
@endsection