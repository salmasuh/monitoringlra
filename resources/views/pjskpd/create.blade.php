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
            <input list="skpd-list" id="skpd_search" class="w-full p-3 border rounded"
                placeholder="Cari SKPD..." autocomplete="off">
            <datalist id="skpd-list">
                @foreach($skpds as $skpd)
                    <option data-id="{{ $skpd->id }}"
                        value="{{ $skpd->nama }}">
                    </option>
                @endforeach
            </datalist>
            <input type="hidden" name="skpd_id" id="skpd_id" required>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const search = document.getElementById('skpd_search');
    const hidden = document.getElementById('skpd_id');

    search.addEventListener('change', function() {
        const options = document.querySelectorAll('#skpd-list option');
        hidden.value = '';

        options.forEach(option => {
            if (option.value === search.value) {
                hidden.value = option.dataset.id;
            }
        });
    });
});
</script>
@endsection