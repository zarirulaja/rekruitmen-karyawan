@extends('layouts.pelamar')

@section('title', 'Daftar Lowongan')

@section('header', 'Daftar Lowongan')

@section('content')
<!-- Search -->
<div class="bg-white rounded-lg shadow-sm p-4 mb-6">
    <form action="{{ route('lowongan') }}" method="GET">
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" 
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari posisi..." 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4 py-1 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                Cari
            </button>
        </div>
    </form>
</div>

<!-- Job Listings -->
<div class="space-y-4">
    @forelse($lowongan as $job)
    <!-- Job Card -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between">
            <div class="flex space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 font-semibold">
                    {{ strtoupper(substr($job->posisi, 0, 2)) }}
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $job->posisi }}</h3>
                    <div class="flex space-x-2 mt-2">
                        <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">{{ $job->tipe_pekerjaan }}</span>
                        <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">{{ $job->lokasi }}</span>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <p class="text-purple-600 font-semibold">
                    @if($job->gaji_min && $job->gaji_max)
                        Rp {{ number_format($job->gaji_min / 1000000, 0) }}-{{ number_format($job->gaji_max / 1000000, 0) }} juta/bulan
                    @else
                        Gaji Dirahasiakan
                    @endif
                </p>
                <p class="text-sm text-gray-500 mt-1">Diposting {{ $job->created_at->diffForHumans() }}</p>
                <div class="mt-4">
                    <a href="{{ route('detail-lowongan', ['id' => $job->id]) }}" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 inline-block">Apply</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-lg shadow-sm p-8 text-center">
        <p class="text-gray-500">Tidak ada lowongan pekerjaan yang tersedia saat ini.</p>
    </div>
    @endforelse
</div>
@endsection