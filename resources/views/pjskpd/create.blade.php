@extends('layouts.app')

@section('title','Data PJ SKPD')
@section('page-title','Data PJ SKPD')
@section('page-subtitle','Kelola daftar Penanggung Jawab SKPD')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl p-7 shadow-sm">
    <h2 class="text-xl font-semibold mb-5">Form Tambah PJ SKPD</h2>

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
    <form action="{{ route('pjskpd.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
        @csrf

        <!-- Nama -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full p-3 border rounded" required>
        </div>

        <!-- NIP -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">NIP</label>
            <input type="text" name="nip" value="{{ old('nip') }}" class="w-full p-3 border rounded">
        </div>

        <!-- SKPD -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">SKPD</label>
            <select name="skpd_id" class="w-full p-3 border rounded" required>
                <option value="">-- Pilih SKPD --</option>
                @foreach($skpds as $skpd)
                    <option value="{{ $skpd->id }}">{{ $skpd->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- HP -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                class="w-full p-3 border rounded">
        </div>

        <!-- Email -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full p-3 border rounded">
        </div>

        <!-- Button -->
        <div class="md:col-span-2 flex gap-4">
            <a href="{{ route('pjskpd.index') }}" class="border px-4 py-3 rounded-xl">
                Kembali
            </a>
            <button class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection