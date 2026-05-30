@extends('layouts.app')

@section('title', 'Data PJ SKPD')
@section('page-title', 'Data PJ SKPD')
@section('page-subtitle', 'Kelola daftar Penanggung Jawab SKPD')

@section('content')
<div class="space-y-6">

    <!-- Header Search + Button -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">

            <!-- Search -->
            <form action="{{ route('pjskpd.index') }}" method="GET" class="w-full mt-3">
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari PJ SKPD..."
                        class="w-full border border-gray-300 rounded-xl px-3 py-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </form>

            <!-- Button Tambah -->
            <a href="{{ route('pjskpd.create') }}"
               class="bg-blue-900 hover:bg-blue-950 mt-3 text-white px-4 py-3 rounded-xl font-semibold flex items-center gap-3 whitespace-nowrap transition">
                + Tambah PJ SKPD
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mt-4 overflow-x-auto">

        <div class="flex justify-between items-center mb-2">

            <!-- Title -->
            <div>
                <h2 class="font-bold text-lg">Daftar PJ SKPD</h2>
                <p class="text-sm text-gray-400 mt-1">Total {{ $pjskpds->count() }} SKPD</p>
            </div>
        </div>

            <!-- Alert -->
            @if(session('success'))
                <div class="text-sm bg-green-100 text-green-700 px-5 py-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="text-sm bg-red-100 text-red-700 px-5 py-4 rounded-xl mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Table -->
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-sm border-b">
                        <th class="py-3 pr-4 font-semibold w-[22%]">Nama</th>
                        <th class="py-3 pr-4 font-semibold w-[18%]">NIP</th>
                        <th class="py-3 pr-4 font-semibold w-[15%]">SKPD</th>
                        <th class="py-3 pr-4 font-semibold w-[15%]">No. HP</th>
                        <th class="py-3 pr-4 font-semibold w-[20%]">Email</th>
                        <th class="py-3 font-semibold text-center w-[10%]">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pjskpds as $item)
                        <tr class="border-b align-top">
                            <td class="py-4 pr-4 break-words">{{ $item->nama }}</td>
                            <td class="py-4 pr-4 break-words">{{ $item->nip }}</td>
                            <td class="py-4 pr-4 break-words">{{ $item->skpd->nama }}</td>
                            <td class="py-4 pr-4 break-words">{{ $item->no_hp }}</td>
                            <td class="py-4 pr-4 break-all text-gray-600">{{ $item->email }}</td>
                            <td class="py-4">
                                <div class="flex justify-center items-center gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('pjskpd.edit', $item->id) }}"
                                        class="border border-gray-300 hover:bg-gray-100 px-3 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition">
                                        <span class="font-semibold">Edit</span>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('pjskpd.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition">
                                            <span class="font-semibold">Hapus</span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500 text-medium">
                                Data PJ SKPD tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
</div>
@endsection