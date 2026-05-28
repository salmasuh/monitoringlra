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
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

        <!-- Title -->
        <div class="mb-8">
            <h2 class="font-semibold text-lg">Daftar PJ SKPD</h2>
            <p class="text-sm text-gray-400 mt-1">Total {{ $pjskpds->count() }} SKPD</p>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="text-sm bg-green-100 text-green-700 px-5 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="w-full overflow-x-auto">
            <!-- Table -->
            <table class="min-w-[1200px] table-fixed border-collapse">
                <thead>
                    <tr class="text-sm border-b text-gray-800">
                        <th class="py-3 font-semibold w-52 text-left">Nama</th>
                        <th class="py-3 font-semibold w-44 text-left">NIP</th>
                        <th class="py-3 font-semibold w-64 text-left">SKPD</th>
                        <th class="py-3 font-semibold w-40 text-left">No. HP</th>
                        <th class="py-3 font-semibold w-64 text-left">Email</th>
                        <th class="py-3 text-center font-semibold w-56">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pjskpds as $item)
                        <tr class="border-b align-top">
                            <td class="py-4 pr-4">
                                <div class="break-words">{{ $item->nama }}</div>
                            </td>

                            <td class="py-4">
                                <div class="break-words">{{ $item->nip }}</div>
                            </td>

                            <td class="py-4">
                                <div class="break-words text-gray-600">{{ $item->skpd->nama }}</div>
                            </td>

                            <td class="py-4">
                                <div class="break-words">{{ $item->no_hp }}</div>
                            </td>

                            <td class="py-4">
                                <div class="break-words">{{ $item->email }}</div>
                            </td>

                            <td class="py-4">
                                <div class="flex justify-center items-center gap-3">

                                    <!-- Edit -->
                                    <a href="{{ route('pjskpd.edit', $item->id) }}"
                                    class="border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-xl flex items-center gap-2 whitespace-nowrap transition">
                                        <span class="font-semibold">Edit</span>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('pjskpd.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl flex items-center gap-2 whitespace-nowrap transition">
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
</div>
@endsection