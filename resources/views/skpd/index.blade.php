@extends('layouts.app')

@section('title','Data SKPD')
@section('page-title','Data SKPD')
@section('page-subtitle','Kelola daftar SKPD')

@section('content')
<div>

    <!-- Header -->
    <div class="flex gap-4 justify-between items-center bg-white rounded-xl border border-gray-200 p-6">

        <!-- Search -->
        <form action="/skpd" method="GET" class="flex-1 mt-3">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari SKPD..." class="w-full border border-gray-300 rounded-xl px-4 py-3">
        </form>

        <!-- Button -->
        <a href="/skpd/create" class="bg-blue-900 hover:bg-blue-950 mt-3 text-white px-4 py-3 rounded-xl font-semibold">
            + Tambah SKPD
        </a>

    </div>
    
    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mt-4">

        <div class="flex justify-between items-center mb-2">
            <div>
                <h2 class="font-semibold text-lg">Daftar SKPD</h2>
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
                    <th class="text-left py-3">Nama SKPD</th>
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