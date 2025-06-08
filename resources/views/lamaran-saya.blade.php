@extends('layouts.pelamar')

@section('title', 'Lamaran Saya')

@section('header', 'Lamaran Saya')

@section('content')
<!-- Success Message -->
@if (session('success'))
<div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
    {{ session('success') }}
</div>
@endif

<!-- Error Message -->
@if (session('error'))
<div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
    {{ session('error') }}
</div>
@endif

<!-- List of Applications -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-lg font-semibold mb-6">Daftar Lamaran</h2>

    @if(count($lamaran) > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Posisi</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Tanggal Apply</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($lamaran as $item)
                <tr>
                    <td class="py-3 px-4">
                        <div>
                            <p class="font-medium text-gray-900">{{ $item->lowongan->judul }}</p>
                            <p class="text-sm text-gray-500">{{ $item->lowongan->posisi }}</p>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-500">
                        {{ $item->tanggal_lamar->format('d F Y') }}
                    </td>
                    <td class="py-3 px-4">
                        @if($item->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($item->status == 'diterima')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Diterima</span>
                        @elseif($item->status == 'ditolak')
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                        @elseif($item->status == 'wawancara')
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Wawancara</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <a href="{{ route('detail-lowongan', ['id' => $item->lowongan_id]) }}" 
                           class="text-purple-600 hover:text-purple-900">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="py-8 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada lamaran</h3>
        <p class="mt-1 text-sm text-gray-500">Anda belum melamar pekerjaan apapun.</p>
        <div class="mt-6">
            <a href="{{ route('lowongan') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                Cari Lowongan
            </a>
        </div>
    </div>
    @endif
</div>
@endsection 