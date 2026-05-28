@extends('layouts.app')

@section('title', 'Data Pengguna')
@section('page-title', 'Data Pengguna')
@section('page-subtitle', 'Kelola akun pengguna sistem monitoring')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 p-7 shadow-sm">
    <h2 class="text-xl font-semibold mb-5">Form Tambah Pengguna</h2>

    <!-- Error -->
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-5 rounded-xl mt-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('pengguna.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
        @csrf
        <!-- Username -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Username</label>
            <input type="text" name="username" value="{{ old('username') }}"
                class="w-full p-3 border rounded" required>
        </div>

        <!-- Password -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Password</label>
            <input type="password" name="password"
                class="w-full p-3 border rounded" required>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full p-3 border rounded" required>
        </div>

        <!-- Role -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Role</label>
            <select name="role" class="w-full p-3 border rounded" required>
                <option value="">-- Pilih Role --</option>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>
                    User
                </option>
                <option value="Pimpinan" {{ old('role') == 'Pimpinan' ? 'selected' : '' }}>
                    Pimpinan
                </option>
            </select>
        </div>

        <!-- Status -->
        <div>
            <label class="block mb-2 font-medium">Status</label>
            <select
                name="status" class="w-full p-3 border rouded" required>
                <option value="">-- Pilih Status --</option>
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>

        <!-- Button -->
        <div class="md:col-span-2 flex gap-4 mt-2">

            <!-- Kembali -->
            <a href="{{ route('pengguna.index') }}" class="border px-4 py-3 rounded-xl">
                Kembali
            </a>

            <!-- Simpan -->
            <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl">
                Simpan
            </button>

        </div>
    </form>
</div>
@endsection