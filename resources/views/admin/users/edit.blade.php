@extends('layouts.admin')

@section('header', 'Edit Pengguna')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Edit Data Pengguna</h3>
        </div>

        <form method="POST"
              action="{{ route('admin.users.update', $user) }}"
              class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4 border-t">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Update Pengguna
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
