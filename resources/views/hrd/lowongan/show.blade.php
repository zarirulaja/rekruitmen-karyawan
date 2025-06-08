@extends('layouts.hrd')

@section('title', 'Detail Lowongan - ' . $lowongan->posisi)

@section('header', 'Detail Lowongan: ' . $lowongan->posisi)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Posisi</h3>
            <p class="text-gray-600">{{ $lowongan->posisi }}</p>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Departemen</h3>
            <p class="text-gray-600">{{ $lowongan->departemen ?? '-' }}</p>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Tipe Pekerjaan</h3>
            <p class="text-gray-600">{{ $lowongan->tipe_pekerjaan }}</p>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Lokasi</h3>
            <p class="text-gray-600">{{ $lowongan->lokasi }}</p>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Status</h3>
            <span class="px-3 py-1 text-sm rounded-full {{ $lowongan->status_text === 'Aktif' ? 'bg-green-100 text-green-700' : ($lowongan->status_text === 'Ditutup' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
                {{ $lowongan->status_text }}
            </span>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Deadline</h3>
            <p class="text-gray-600">{{ $lowongan->formatted_deadline }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Deskripsi</h3>
        <div class="prose max-w-none text-gray-600">
            {!! nl2br(e($lowongan->deskripsi)) !!}
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Kualifikasi</h3>
        <div class="prose max-w-none text-gray-600">
            {!! nl2br(e($lowongan->kualifikasi)) !!}
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Benefit</h3>
        <div class="prose max-w-none text-gray-600">
            {!! nl2br(e($lowongan->benefit)) !!}
        </div>
    </div>

    <div class="mt-8 flex space-x-3">
        <a href="{{ route('hrd.lowongan.edit', $lowongan->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
            Edit Lowongan
        </a>
        <a href="{{ route('hrd.lowongan') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
            Kembali ke Daftar Lowongan
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Daftar Pelamar ({{ $lamaran->total() }})</h2>

    @if($lamaran->isEmpty())
        <p class="text-gray-500 text-center py-4">Belum ada pelamar untuk lowongan ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-500 text-sm border-b">
                        <th class="pb-4">Nama Pelamar</th>
                        <th class="pb-4">Email</th>
                        <th class="pb-4">Tanggal Melamar</th>
                        <th class="pb-4">Status Lamaran</th>
                        <th class="pb-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach($lamaran as $app)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-4">{{ $app->pelamar->user->name ?? 'N/A' }}</td>
                            <td class="py-4">{{ $app->pelamar->user->email ?? 'N/A' }}</td>
                            <td class="py-4">{{ $app->created_at ? $app->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td class="py-4">
                                <span class="px-3 py-1 text-xs rounded-full font-medium 
                                    {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $app->status === 'review' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $app->status === 'wawancara' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $app->status === 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $app->status === 'ditolak' ? 'bg-red-100 text-red-700' : '' }}
                                ">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="py-4">
                                <a href="{{ route('hrd.pelamar.show', $app->pelamar->id) }}" class="text-purple-600 hover:text-purple-700">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination for Applicants -->
        @if ($lamaran->hasPages())
            <div class="mt-6">
                {{ $lamaran->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
