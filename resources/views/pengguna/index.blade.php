@extends('layouts.app')

@section('title','Data Pengguna')
@section('page-title','Data Pengguna')
@section('page-subtitle','Kelola akun pengguna sistem monitoring')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">

            <!-- Search -->
            <form action="{{ route('pengguna.index') }}" method="GET" class="w-full mt-3">
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pengguna..."
                        class="w-full border border-gray-300 rounded-xl px-3 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </form>

            <!-- Button -->
            <a href="{{ route('pengguna.create') }}"
               class="bg-blue-900 hover:bg-blue-950 mt-3 text-white px-4 py-3 rounded-xl font-semibold flex items-center gap-3 whitespace-nowrap transition">
                + Tambah Pengguna
            </a>

        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mt-4 overflow-x-auto">

        <div class="flex justify-between items-center mb-2">
            <!-- Title -->
            <div>
                <h2 class="font-bold text-lg">Daftar Pengguna</h2>
                <p class="text-sm text-gray-400 mt-1">Total {{ $users->count() }} pengguna</p>
            </div>
        </div>

        @if(session('success'))
            <div class="text-sm bg-green-100 text-green-700 px-5 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-sm border-b">
                    <th class="py-3 pr-4 font-semibold w-[30%]">Username</th>
                    <th class="py-3 pr-4 font-semibold w-[20%]">Role</th>
                    <th class="py-3 pr-4 font-semibold w-[20%]">Status</th>
                    <th class="py-3 text-center font-semibold w-[30%]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $item)
                    <tr class="border-b align-top">
                        <td class="py-4 pr-4 break-words">{{ $item->username }}</td>
                        <td class="py-4 pr-4 break-words">
                            @if($item->role == 'Admin')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Admin
                                </span>
                            @elseif($item->role == 'Pimpinan')
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Pimpinan
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    User
                                </span>
                            @endif
                        </td>
                        <td class="py-4 pr-4 break-words">
                            @if($item->status == 'Aktif')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Aktif
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-4">
                            <div class="flex justify-center items-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('pengguna.edit', $item->id) }}"
                                   class="border border-gray-300 hover:bg-gray-100 px-3 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('pengguna.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Yakin hapus pengguna?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500 text-medium">
                            Data pengguna tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection