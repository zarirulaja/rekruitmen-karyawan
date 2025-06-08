@extends('layouts.pelamar')

@section('title', 'Dashboard Pelamar')

@section('header', 'Dashboard Pelamar')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Lamaran Aktif</h3>
        <p class="text-4xl font-semibold text-[#7E3AF2]">{{ $activeApplicationsCount }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Wawancara</h3>
        <p class="text-4xl font-semibold text-[#F472B6]">{{ $interviewCount }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Lowongan Tersimpan</h3>
        <p class="text-4xl font-semibold text-[#0EA5E9]">{{ $savedJobsCount }}</p>
    </div>
</div>

<!-- Recent Applications -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Lamaran Terbaru</h2>
        <a href="{{ route('lamaran-saya') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">Lihat Semua</a>
    </div>
    
    @if(count($recentApplications) > 0)
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-gray-500 text-sm">
                    <th class="pb-4">Posisi</th>
                    <th class="pb-4">Tanggal Apply</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($recentApplications as $application)
                <tr class="border-t">
                    <td class="py-4">{{ $application->lowongan->posisi }}</td>
                    <td>{{ $application->tanggal_lamar->format('d F Y') }}</td>
                    <td>
                        @if($application->status == 'pending')
                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                        @elseif($application->status == 'review')
                            <span class="px-3 py-1 text-sm rounded-full bg-purple-100 text-purple-700">Review</span>
                        @elseif($application->status == 'wawancara')
                            <span class="px-3 py-1 text-sm rounded-full bg-pink-100 text-pink-700">Wawancara</span>
                        @elseif($application->status == 'diterima')
                            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">Diterima</span>
                        @elseif($application->status == 'ditolak')
                            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('detail-lowongan', ['id' => $application->lowongan_id]) }}" class="text-gray-600 hover:text-gray-900">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-8 text-gray-500">
        <p>Anda belum memiliki lamaran.</p>
        <a href="{{ route('lowongan') }}" class="mt-2 inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Cari Lowongan</a>
    </div>
    @endif
</div>

<!-- Interview Schedule -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-lg font-semibold mb-4">Jadwal Wawancara</h2>
    
    @if($upcomingInterviews)
    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
        <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white">
            {{ strtoupper(substr($upcomingInterviews->lowongan->posisi, 0, 2)) }}
        </div>
        <div>
            <h3 class="font-semibold">{{ $upcomingInterviews->lowongan->posisi }}</h3>
            <p class="text-gray-500 text-sm">{{ $upcomingInterviews->tanggal_lamar->format('d F Y') }}</p>
        </div>
    </div>
    @else
    <div class="text-center py-8 text-gray-500">
        <p>Tidak ada jadwal wawancara dalam waktu dekat.</p>
    </div>
    @endif
</div>
@endsection