@extends('layouts.app')

@section('title', 'Data Pengguna')
@section('page-title', 'Data Pengguna')
@section('page-subtitle', 'Kelola akun pengguna sistem monitoring')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl p-7 shadow-sm">
    <h2 class="text-xl font-semibold mb-5">Form Edit Pengguna</h2>

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
    
    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST" class="grid md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label class="block mb-2 font-medium">Username</label>
            <input type="text" name="username" value="{{ $pengguna->username }}" class="w-full p-3 border rounded" required>
        </div>

        <div class="mb-2">
            <label class="block mb-2 font-medium">Password Baru</label>
            <input type="password" name="password" class="w-full p-3 border rounded">
                <small class="text-gray-400">Kosongkan jika tidak ingin mengganti password</small>
        </div>

        <div class="mb-2">
            <label class="font-medium block mb-2">Role</label>
            <select name="role" class="w-full p-3 border rounded" required>
                <option value="Admin" {{ $pengguna->role == 'Admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="User" {{ $pengguna->role == 'User' ? 'selected' : '' }}>
                    User
                </option>
                <option value="Pimpinan" {{ $pengguna->role == 'Pimpinan' ? 'selected' : '' }}>
                    Pimpinan
                </option>
            </select>
        </div>

        <div class="mb-2">
            <label class="font-medium block mb-2">Status</label>
            <select name="status" class="w-full p-3 border rounded" required>
                <option value="Aktif" {{ $pengguna->status == 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="Nonaktif" {{ $pengguna->status == 'Nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('pengguna.index') }}" class="border px-4 py-2 rounded-xl">
                Kembali
            </a>
            <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection