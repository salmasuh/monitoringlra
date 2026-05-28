@extends('layouts.app')

@section('title','Data SKPD')
@section('page-title','Data SKPD')
@section('page-subtitle','Kelola daftar Satuan Kerja Perangkat Daerah (SKPD)')

@section('content')
<div class="space-y-6">

    <!-- Header Search + Button -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">

            <!-- Search -->
            <form action="{{ route('skpd.index') }}" method="GET" class="w-full mt-3">
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari SKPD..."
                        class="w-full border border-gray-300 rounded-xl px-3 py-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </form>

            <!-- Button Tambah -->
            <a href="{{ route('skpd.create') }}"
               class="bg-blue-900 hover:bg-blue-950 mt-3 text-white px-4 py-3 rounded-xl font-semibold flex items-center gap-3 whitespace-nowrap transition">
                + Tambah SKPD
            </a>
        </div>
    </div>
    
    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mt-4 overflow-x-auto">

        <div class="flex justify-between items-center mb-2">
            <div>
                <h2 class="font-bold text-lg">Daftar SKPD</h2>
                <p class="text-sm text-gray-400 mt-1">Total {{ $skpds->count() }} SKPD</p>
            </div>
        </div>
        <!-- Alert -->
    @if(session('success'))
        <div class="text-sm bg-green-100 text-green-700 px-5 py-4 mt-6 rounded-xl">
            {{ session('success') }}
        </div>
    @endif
        <table class="w-full table-fixed text-left">
            <thead>
                <tr class="text-sm border-b">
                    <th class="text-left font-semibold py-3">Nama SKPD</th>
                    <th class="text-left py-3">Singkatan</th>
                    <th class="text-left py-3">Deskripsi </th>
                    <th class="text-center py-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($skpds as $item)
                    <tr class="border-b align-top">
                        <td class="py-3">{{ $item->nama }}</td>
                        <td class="py-3">{{ $item->singkatan }}</td>
                        <td class="py-3 break-words">{{ $item->deskripsi }}</td>

                        <td class="py-3">
                            <div class="flex justify-center gap-3">

                                <!-- Edit -->
                                <a href="/skpd/{{ $item->id }}/edit" class="bg-gray-100 hover:bg-gray-200 px-5 py-2 rounded-xl">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="/skpd/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data?')" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty

                    <tr>
                        <td colspan="4" class="text-sm text-center py-5 text-gray-500">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection