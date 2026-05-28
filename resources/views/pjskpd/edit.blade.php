@extends('layouts.app')

@section('title','Data PJ SKPD')
@section('page-title','Data PJ SKPD')
@section('page-subtitle','Kelola daftar Penanggung Jawab SKPD')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl p-7 shadow-sm">
    <h2 class="text-xl font-semibold mb-5">Form Edit PJ SKPD</h2>
    
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
    <form action="{{ route('pjskpd.update', $pjskpd->id) }}" method="POST" class="grid md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pjskpd->nama) }}" class="w-full p-3 border rounded" required>
        </div>

        <!-- NIP -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">NIP</label>
            <input type="text" name="nip" value="{{ old('nip', $pjskpd->nip) }}" class="w-full p-3 border rounded">
        </div>

        <!-- SKPD -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">SKPD</label>
            <select name="skpd_id" class="w-full p-3 border rounded" required>
                @foreach($skpds as $skpd)
                    <option value="{{ $skpd->id }}"
                        @selected($pjskpd->skpd_id == $skpd->id)>
                        {{ $skpd->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- HP -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $pjskpd->no_hp) }}"
                class="w-full p-3 border rounded">
        </div>

        <!-- Email -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $pjskpd->email) }}"
                class="w-full p-3 border rounded">
        </div>

        <!-- Button -->
        <div class="md:col-span-2 flex gap-4">
            <a href="{{ route('pjskpd.index') }}" class="border px-4 py-2 rounded-xl">
                Kembali
            </a>
            <button class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection