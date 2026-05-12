@props(['bank', 'size' => 'sm'])

@php
    $sizeClasses = [
        'sm' => 'w-10 h-10',
        'md' => 'w-16 h-16',
        'lg' => 'w-20 h-20',
        'xl' => 'w-28 h-28'
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    
    // Map logo berdasarkan nama bank
    $logoMap = [
        'Bank Mandiri' => 'mandiri.png',
        'Bank BRI' => 'bri.png',
        'Bank BCA' => 'bca.png',
        'Bank Niaga' => 'niaga.png',
        'Bank CIMB Niaga' => 'niaga.png',
        'CIMB Niaga' => 'niaga.png',
    ];
    
    // Fallback: gunakan nama bank (lowercase, remove "Bank ")
    $bankNameSlug = strtolower(str_replace(['Bank ', ' '], ['', '-'], $bank->nama_bank));
    $logoFile = $logoMap[$bank->nama_bank] ?? $bankNameSlug . '.png';
    $logoPath = asset('images/banks/' . $logoFile);
    
    // Cek apakah file ada
    $useImage = file_exists(public_path('images/banks/' . $logoFile));
    
    // Gunakan warna dari database, atau fallback ke default
    $colorPrimary = $bank->color_primary ?? '#3B82F6';
    $colorSecondary = $bank->color_secondary ?? '#1E40AF';
    
    // Ambil inisial bank (3 huruf pertama setelah "Bank")
    $bankInitial = strtoupper(substr(str_replace('Bank ', '', $bank->nama_bank), 0, 3));
@endphp

@if($useImage)
    <!-- Menggunakan gambar logo asli -->
    <div class="{{ $sizeClass }} flex items-center justify-center bg-white rounded-lg shadow-md p-2 flex-shrink-0">
        <img src="{{ $logoPath }}" 
             alt="{{ $bank->nama_bank }}" 
             class="w-full h-full object-contain"
             onerror="this.parentElement.innerHTML='<div class=\'w-full h-full rounded-lg flex items-center justify-center\' style=\'background: linear-gradient(135deg, {{ $colorPrimary }} 0%, {{ $colorSecondary }} 100%);\'><span class=\'text-white font-bold text-sm\'>{{ $bankInitial }}</span></div>'">
    </div>
@else
    <!-- Fallback: Icon placeholder dengan inisial bank -->
    <div class="{{ $sizeClass }} rounded-lg flex items-center justify-center shadow-lg flex-shrink-0"
         style="background: linear-gradient(135deg, {{ $colorPrimary }} 0%, {{ $colorSecondary }} 100%);">
        <span class="text-white font-bold text-sm">
            {{ $bankInitial }}
        </span>
    </div>
@endif  