<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Artikel Edukasi') }}
            </h2>
            <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
                + Tambah Artikel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($articles as $article)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($article->image_url)
                                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-16 h-16 object-cover rounded mr-3">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $article->title }}</p>
                                                <p class="text-sm text-gray-500">{{ Str::limit($article->description, 50) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $article->category_color['badge'] }} text-white">
                                            {{ $article->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($article->is_published)
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Published</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-gray-100 text-gray-800">Draft</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-500">
                                        {{ $article->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada artikel. <a href="{{ route('admin.articles.create') }}" class="text-blue-600 hover:underline">Tambah artikel pertama</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>