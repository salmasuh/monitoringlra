@extends('layouts.app')

@section('title','Data SKPD')
@section('page-title','Data SKPD')
@section('page-subtitle','Kelola daftar SKPD')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 p-7">
    <h2 class="text-lg font-semibold mb-4">Edit SKPD</h2>

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
    <form action="/skpd/{{ $skpd->id }}" method="POST" class="grid md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-3">
            <label class="block mb-3 font-medium">Nama SKPD</label>
            <input type="text" name="nama" value="{{ old('nama', $skpd->nama) }}" class="w-full p-3 border rounded"required>
        </div>

        <!-- Singkatan -->
        <div class="mb-3">
            <label class="block mb-3 font-medium">Singkatan</label>
            <input type="text" name="singkatan" value="{{ old('singkatan', $skpd->singkatan) }}" class="w-full p-3 border rounded" required>
        </div>

        <!-- Deskripsi -->
        <div class="md:col-span-2">
            <label class="block mb-3 font-medium">Deskripsi (opsional)</label>
            <textarea name="deskripsi" class="w-full p-3 border rounded">{{ old('deskripsi', $skpd->deskripsi) }}</textarea>
        </div>

        <!-- Button -->
        <div class="flex gap-4">
            <a href="/skpd" class="border px-4 py-3 rounded-xl">Kembali</a>
            <button class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection