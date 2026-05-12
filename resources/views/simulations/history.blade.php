<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Simulasi Deposito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($simulations->count() > 0)
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">Bank</th>
                                    <th scope="col" class="px-6 py-3">Nominal</th>
                                    <th scope="col" class="px-6 py-3">Tenor</th>
                                    <th scope="col" class="px-6 py-3">Bunga</th>
                                    <th scope="col" class="px-6 py-3">Total Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($simulations as $simulation)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $simulation->waktu_simulasi->format('d/m/Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $simulation->waktu_simulasi->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <x-bank-icon :bank="$simulation->bank" size="sm" />
                                            <span class="ml-3 font-medium text-gray-900">
                                                {{ $simulation->bank->nama_bank }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        Rp {{ number_format($simulation->nominal_deposito, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $simulation->jangka_waktu_bulan }} bulan
                                    </td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">
                                        Rp {{ number_format($simulation->bunga_diterima, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-blue-600 font-bold">
                                        Rp {{ number_format($simulation->total_akhir, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $simulations->links() }}
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada riwayat</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat simulasi deposito baru.</p>
                        <div class="mt-6">
                            <a href="{{ route('simulations.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Simulasi Baru
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>