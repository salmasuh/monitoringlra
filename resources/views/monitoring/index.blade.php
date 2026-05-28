@extends('layouts.app')

@section('title', 'Monitoring Data')
@section('page-title', 'Monitoring Data')
@section('page-subtitle', 'Input dan kelola data monitoring pencairan penerimaan kas SKPD')

@section('content')
<div class="space-y-6">

    <!-- Search -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
            <form action="{{ route('monitoring.index') }}" method="GET" class="w-full mt-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari SKPD atau PJ..."
                    class="w-full border border-gray-300 rounded-xl px-3 py-4">
            </form>

            <a href="{{ route('monitoring.create') }}" class="bg-blue-900 hover:bg-blue-950 mt-3 text-white px-4 py-3 rounded-xl font-semibold whitespace-nowrap">
                + Input Monitoring
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mt-4 overflow-x-auto">
        <div class="flex justify-between items-center mb-2">

            <!-- Title -->
            <div>
                <h2 class="font-bold text-lg">Daftar Monitoring</h2>
                <p class="text-sm text-gray-400 mt-1">Total {{ $monitorings->count() }} monitoring</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-5 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-sm border-b">
                    <th class="py-3 pr-4 font-semibold w-[18%]">SKPD</th>
                    <th class="py-3 pr-4 font-semibold w-[18%]">PJ SKPD</th>
                    <th class="py-3 pr-4 font-semibold w-[15%]">Status</th>
                    <th class="py-3 pr-4 font-semibold w-[15%]">Tanggal Update</th>
                    <th class="py-3 pr-4 font-semibold w-[20%]">Catatan</th>
                    <th class="py-3 text-center font-semibold w-[14%]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($monitorings as $item)
                    <tr class="border-b align-top">
                        <td class="py-4 pr-4 break-words">{{ $item->skpd->nama }}</td>
                        <td class="py-4 pr-4 break-words">{{ $item->pjskpd->nama }}</td>
                        <td class="py-4 pr-4 break-words">
                             @if($item->status == 'Sudah Selesai')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-sm font-semibold">
                                    Sudah Selesai
                                </span>
                            @elseif($item->status == 'Perlu Review')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-sm font-semibold">
                                    Perlu Review
                                </span>
                            @elseif($item->status == 'Belum Update')
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-sm font-semibold">
                                    Belum Update
                                </span>
                            @elseif($item->status == 'Dalam Proses')
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm font-semibold">
                                    Dalam Proses
                                </span>
                            @endif
                        </td>
                        <td class="py-4 pr-4 break-words">{{ \Carbon\Carbon::parse($item->tanggal_update)->format('d-m-Y') }}</td>
                        <td class="py-4 pr-4 break-all text-gray-600">{{ $item->catatan }}</td>
                        <td class="py-4">
                            <div class="flex justify-center items-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('monitoring.edit', $item->id) }}"
                                    class="border border-gray-300 hover:bg-gray-100 px-3 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition">
                                    <span class="font-semibold">Edit</span>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('monitoring.destroy', $item->id) }}" method="POST">
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
                            Data monitoring tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection