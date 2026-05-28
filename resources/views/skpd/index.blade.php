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
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-sm border-b">
                    <th class="py-3 pr-4 font-semibold w-[25%]">Nama SKPD</th>
                    <th class="py-3 pr-4 font-semibold w-[15%]">Singkatan</th>
                    <th class="py-3 pr-4 font-semibold w-[40%]">Deskripsi </th>
                    <th class="py-3 text-center font-semibold w-[20%]">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($skpds as $item)
                    <tr class="border-b align-top">
                        <td class="py-3 pr-4 break-words font-medium text-gray-900">{{ $item->nama }}</td>
                        <td class="py-3 pr-4 break-words text-gray-700">{{ $item->singkatan }}</td>
                        <td class="py-3 pr-4 break-words text-gray-600 leading-relaxed">{{ $item->deskripsi }}</td>

                        <td class="py-3">
                            <div class="flex justify-center items-center gap-2">

                                <!-- Edit -->
                                <a href="/skpd/{{ $item->id }}/edit" class="border border-gray-300 hover:bg-gray-100 px-3 py-2 rounded-xl text-sm font-semibold transition whitespace-nowrap">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="/skpd/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data?')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty

                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500 text-medium">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection