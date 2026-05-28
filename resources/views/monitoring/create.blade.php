@extends('layouts.app')

@section('title', 'Monitoring Data')
@section('page-title', 'Monitoring Data')
@section('page-subtitle', 'Input dan kelola data monitoring pencairan penerimaan kas SKPD')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl p-7 shadow-sm">
    <h2 class="text-xl font-semibold mb-5">Form Input Monitoring</h2>

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

    <form action="{{ route('monitoring.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
        @csrf

         <!-- SKPD -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">SKPD</label>
            <select name="skpd_id" onchange="window.location='?skpd_id='+this.value"
                class="w-full p-3 border rounded" required>
                <option value="">-- Pilih SKPD --</option>
                @foreach($skpds as $skpd)
                    <option value="{{ $skpd->id }}"
                        @selected($selectedSkpd == $skpd->id)>
                        {{ $skpd->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- PJ -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">PJ SKPD</label>
            <select name="pj_skpd_id" class="w-full p-3 border rounded" required>
                <option value="">-- Pilih PJ --</option>
                @foreach($pjskpds as $pj)
                    <option value="{{ $pj->id }}">{{ $pj->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div class="mb-2">
            <label class="block mb-2 font-medium">Status</label>
            <select name="status" class="w-full p-3 border rounded" required>
                <option>Belum Update</option>
                <option>Dalam Proses</option>
                <option>Perlu Review</option>
                <option>Sudah Selesai</option>
            </select>
        </div>

        <!-- Catatan -->
        <div class="md:col-span-2">
            <label class="block mb-2 font-medium">Catatan</label>
            <textarea name="catatan" rows="2" class="w-full p-3 border rounded"></textarea>
        </div>

        <div class="md:col-span-2 flex gap-4">
            <a href="{{ route('monitoring.index') }}" class="border px-4 py-3 rounded-xl">
                Kembali
            </a>
            <button class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection