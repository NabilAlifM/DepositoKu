@extends('layouts.admin')

@section('header', isset($bank) ? 'Edit Bank' : 'Tambah Bank')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">{{ isset($bank) ? 'Edit' : 'Tambah' }} Data Bank</h3>
        </div>
        
        <form action="{{ isset($bank) ? route('admin.banks.update', $bank->bank_id) : route('admin.banks.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="p-6 space-y-6">
            @csrf
            @if(isset($bank))
                @method('PUT')
            @endif

            <!-- Nama Bank -->
            <div>
                <label for="nama_bank" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Bank <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_bank" 
                       name="nama_bank" 
                       value="{{ old('nama_bank', $bank->nama_bank ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_bank') border-red-500 @enderror"
                       required>
                @error('nama_bank')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- PT -->
            <div>
                <label for="pt" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama PT (Opsional)
                </label>
                <input type="text" 
                       id="pt" 
                       name="pt" 
                       value="{{ old('pt', $bank->pt ?? '') }}"
                       placeholder="Contoh: PT Bank Mandiri (Persero) Tbk"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Logo -->
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                    Logo Bank
                </label>
                @if(isset($bank) && $bank->logo_url)
                    <div class="mb-3">
                        <img src="{{ asset($bank->logo_url) }}" alt="{{ $bank->nama_bank }}" class="w-32 h-32 object-contain border rounded p-2">
                    </div>
                @endif
                <input type="file" 
                       id="logo" 
                       name="logo" 
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('logo') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Max: 2MB</p>
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Suku Bunga -->
            <div>
                <label for="suku_bunga_dasar" class="block text-sm font-medium text-gray-700 mb-2">
                    Suku Bunga Dasar (% per tahun) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="number" 
                           id="suku_bunga_dasar" 
                           name="suku_bunga_dasar" 
                           value="{{ old('suku_bunga_dasar', $bank->suku_bunga_dasar ?? '') }}"
                           step="0.01"
                           min="0"
                           max="100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('suku_bunga_dasar') border-red-500 @enderror"
                           required>
                    <span class="absolute right-4 top-2.5 text-gray-500">%</span>
                </div>
                @error('suku_bunga_dasar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warna Primary -->
            <div>
                <label for="color_primary" class="block text-sm font-medium text-gray-700 mb-2">
                    Warna Primary <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-3 items-center">
                    <input type="color" 
                           id="color_primary" 
                           name="color_primary" 
                           value="{{ old('color_primary', $bank->color_primary ?? '#3B82F6') }}"
                           class="h-12 w-20 border border-gray-300 rounded cursor-pointer">
                    <input type="text" 
                           id="color_primary_text"
                           value="{{ old('color_primary', $bank->color_primary ?? '#3B82F6') }}"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           readonly>
                </div>
            </div>

            <!-- Warna Secondary -->
            <div>
                <label for="color_secondary" class="block text-sm font-medium text-gray-700 mb-2">
                    Warna Secondary <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-3 items-center">
                    <input type="color" 
                           id="color_secondary" 
                           name="color_secondary" 
                           value="{{ old('color_secondary', $bank->color_secondary ?? '#1E40AF') }}"
                           class="h-12 w-20 border border-gray-300 rounded cursor-pointer">
                    <input type="text" 
                           id="color_secondary_text"
                           value="{{ old('color_secondary', $bank->color_secondary ?? '#1E40AF') }}"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           readonly>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4 border-t">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    {{ isset($bank) ? 'Update Bank' : 'Tambah Bank' }}
                </button>
                <a href="{{ route('admin.banks.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Sync color picker with text input
    document.getElementById('color_primary').addEventListener('input', function(e) {
        document.getElementById('color_primary_text').value = e.target.value;
    });
    
    document.getElementById('color_secondary').addEventListener('input', function(e) {
        document.getElementById('color_secondary_text').value = e.target.value;
    });
</script>
@endsection