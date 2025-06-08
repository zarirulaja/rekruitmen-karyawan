@extends('layouts.hrd')

@section('title', 'Kelola Lowongan')

@section('header', 'Kelola Lowongan')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Header with Actions -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <form action="{{ route('hrd.lowongan') }}" method="GET" class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lowongan..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Ditutup</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </form>
        </div>
        <a href="{{ route('hrd.lowongan.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
            + Tambah Lowongan
        </a>
    </div>

    <!-- Job Listings Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-gray-500 text-sm border-b">
                    <th class="pb-4">Posisi</th>
                    <th class="pb-4">Departemen</th>
                    <th class="pb-4">Tipe</th>
                    <th class="pb-4">Total Pelamar</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Deadline</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse($lowongan as $job)
                <tr class="border-b">
                    <td class="py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $job->posisi }}</h3>
                                <p class="text-sm text-gray-500">{{ $job->lokasi }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4">{{ $job->departemen ?? '-' }}</td>
                    <td class="py-4">{{ $job->tipe_pekerjaan }}</td>
                    <td class="py-4">{{ $job->lamaran_count }}</td>
                    <td class="py-4">
                        <span class="px-3 py-1 text-sm rounded-full {{ $job->status_text === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $job->status_text }}
                        </span>
                    </td>
                    <td class="py-4">{{ $job->formatted_deadline }}</td>
                    <td class="py-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('hrd.lowongan.edit', $job->id) }}" class="text-purple-600 hover:text-purple-700">Edit</a>
                            <a href="{{ route('hrd.lowongan.show', $job->id) }}" class="text-gray-600 hover:text-gray-700">Lihat</a>
                            <form action="{{ route('hrd.lowongan.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-500">
                        Tidak ada lowongan yang ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <p class="text-sm text-gray-500">
            Menampilkan {{ $from }}-{{ $to }} dari {{ $total }} lowongan
        </p>
        <div class="flex items-center space-x-2">
            {{ $lowongan->links() }}
        </div>
    </div>
</div>
@endsection 