@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Monitoring Workflow LRA Mingguan')
@section('page-subtitle', 'Montoring Proses Penyusunan LRA Mingguan Pemerintah Kabupaten Kampar')

@section('content')

<div class="space-y-6">

    <!-- FILTER -->
    <div class="bg-white border rounded-2xl p-6">

        <form method="GET" action="{{ route('dashboard.index') }}">

            <div class="grid md:grid-cols-5 gap-4">

                <!-- Periode -->
                <div>

                    <label class="text-sm font-semibold mb-2 block">
                        Periode Minggu
                    </label>

                    <select
                        name="periode"
                        onchange="this.form.submit()"
                        class="w-full border rounded-xl p-3"
                    >

                        @foreach($periodeList as $periode)

                            <option
                                value="{{ $periode['value'] }}"
                                {{ $selectedWeek == $periode['value'] ? 'selected' : '' }}
                            >
                                {{ $periode['label'] }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Tahun -->
                <div>

                    <label class="text-sm font-semibold mb-2 block">
                        Tahun
                    </label>

                    <select class="w-full border rounded-xl p-3">

                        @foreach($tahunList as $tahun)

                            <option>
                                {{ $tahun }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- SKPD -->
                <div>

                    <label class="text-sm font-semibold mb-2 block">
                        SKPD
                    </label>

                    <select class="w-full border rounded-xl p-3">

                        <option>Semua SKPD</option>

                        @foreach($skpdList as $skpd)

                            <option>
                                {{ $skpd }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- PJ -->
                <div>

                    <label class="text-sm font-semibold mb-2 block">
                        PJ SKPD
                    </label>

                    <select class="w-full border rounded-xl p-3">

                        <option>Semua PJ</option>

                        @foreach($pjList as $pj)

                            <option>
                                {{ $pj }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Status -->
                <div>

                    <label class="text-sm font-semibold mb-2 block">
                        Status
                    </label>

                    <select class="w-full border rounded-xl p-3">

                        <option>Semua</option>
                        <option>Sudah Selesai</option>
                        <option>Dalam Proses</option>
                        <option>Perlu Review</option>
                        <option>Belum Update</option>

                    </select>

                </div>

            </div>

        </form>

    </div>

    <!-- CARD -->
    <div class="grid md:grid-cols-5 gap-4">

        <div class="bg-white border rounded-2xl p-6">
            <p class="text-gray-500">Total SKPD</p>
            <h1 class="text-4xl font-bold text-blue-700 mt-3">
                {{ $totalSkpd }}
            </h1>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <p class="text-gray-500">Sudah Selesai</p>
            <h1 class="text-4xl font-bold text-green-600 mt-3">
                {{ $selesai }}
            </h1>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <p class="text-gray-500">Perlu Review</p>
            <h1 class="text-4xl font-bold text-yellow-500 mt-3">
                {{ $review }}
            </h1>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <p class="text-gray-500">Belum Update</p>
            <h1 class="text-4xl font-bold text-red-500 mt-3">
                {{ $belum }}
            </h1>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <p class="text-gray-500">Progress Konsolidasi</p>
            <h1 class="text-4xl font-bold text-cyan-600 mt-3">
                {{ $progress }}%
            </h1>
        </div>

    </div>

    <!-- CHART -->
    <div class="grid md:grid-cols-2 gap-6">

        <!-- Workflow -->
        <div class="bg-white border rounded-2xl p-6">

            <h2 class="font-bold text-lg mb-4">
                Status Workflow
            </h2>

            <div class="space-y-3">

                <div class="flex justify-between">
                    <span>Sudah Selesai</span>
                    <span>{{ $selesai }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Dalam Proses</span>
                    <span>{{ $dalamProses }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Perlu Review</span>
                    <span>{{ $review }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Belum Update</span>
                    <span>{{ $belum }}</span>
                </div>

            </div>

        </div>

        <!-- Trend -->
        <div class="bg-white border rounded-2xl p-6">

            <h2 class="font-bold text-lg mb-4">
                Tren Penyelesaian Mingguan
            </h2>

            <div class="space-y-3">

                @foreach($trendLabels as $index => $label)

                    <div class="flex justify-between">

                        <span>{{ $label }}</span>

                        <span>
                            {{ $trendData[$index] }}%
                        </span>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    <!-- PROGRESS PJ -->
    <div class="bg-white border rounded-2xl p-6">

        <h2 class="font-bold text-lg mb-5">
            Progress per PJ SKPD
        </h2>

        <div class="space-y-4">

            @foreach($progressPj as $pj)

                <div>

                    <div class="flex justify-between mb-1">

                        <span>{{ $pj['nama'] }}</span>

                        <span>{{ $pj['persen'] }}%</span>

                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="bg-cyan-500 h-3 rounded-full"
                            style="width: {{ $pj['persen'] }}%"
                        ></div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-2xl p-6 overflow-x-auto">

        <div class="flex justify-between items-center mb-4">

            <div>
                <h2 class="font-bold text-lg">
                    Monitoring PJ SKPD
                </h2>

                <p class="text-gray-500 text-sm">
                    Data monitoring sesuai periode minggu
                </p>
            </div>

        </div>

        <table class="w-full text-left border-collapse">

            <thead>

                <tr class="border-b text-sm">

                    <th class="py-3">SKPD</th>
                    <th class="py-3">PJ</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Tanggal</th>
                    <th class="py-3">Catatan</th>

                </tr>

            </thead>

            <tbody>

                @forelse($monitorings as $item)

                    <tr class="border-b">

                        <td class="py-3">
                            {{ $item->skpd->nama }}
                        </td>

                        <td class="py-3">
                            {{ $item->pjskpd->nama }}
                        </td>

                        <td class="py-3">

                            @if($item->status == 'Sudah Selesai')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Sudah Selesai
                                </span>

                            @elseif($item->status == 'Perlu Review')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Perlu Review
                                </span>

                            @elseif($item->status == 'Belum Update')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Belum Update
                                </span>

                            @else

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                    Dalam Proses
                                </span>

                            @endif

                        </td>

                        <td class="py-3">
                            {{ \Carbon\Carbon::parse($item->tanggal_update)->format('d-m-Y') }}
                        </td>

                        <td class="py-3">
                            {{ $item->catatan }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-10 text-gray-500">
                            Data monitoring tidak tersedia
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection