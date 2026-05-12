<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                     <form action="{{ route('admin.articles.update', $article) }}" method="POST">
        @csrf
        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                            <select name="category" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi Singkat</label>
                            <textarea name="description" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Konten Artikel (Opsional)</label>
                            <textarea name="content" rows="10" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('content') }}</textarea>
                        </div>

                        <!-- Image URL -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">URL Gambar</label>
                            <input type="url" name="image_url" value="{{ old('image_url') }}" 
                                   placeholder="https://example.com/image.jpg"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-sm text-gray-500 mt-1">Gunakan URL gambar dari Unsplash atau sumber lain. Ukuran rekomendasi: 400x300px</p>
                        </div>

                        <!-- Published -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-gray-700">Publikasikan artikel</span>
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition">
                                Simpan Artikel
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>