@extends('layouts.hrd')

@section('title', 'Dashboard HR')

@section('header', 'Dashboard HR')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Total Lowongan</h3>
        <p class="text-4xl font-semibold text-[#7E3AF2]">{{ $totalLowongan }}</p>
        <p class="text-sm text-gray-500 mt-2">{{ $lowonganChange >= 0 ? '+' : '' }}{{ $lowonganChange }} dari bulan lalu</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Total Pelamar</h3>
        <p class="text-4xl font-semibold text-[#F472B6]">{{ $totalPelamar }}</p>
        <p class="text-sm text-gray-500 mt-2">+{{ $pelamarChange }} dari minggu lalu</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Wawancara</h3>
        <p class="text-4xl font-semibold text-[#0EA5E9]">{{ $todayInterviews }}</p>
        <p class="text-sm text-gray-500 mt-2">Hari ini</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-gray-500 text-sm mb-2">Diterima</h3>
        <p class="text-4xl font-semibold text-[#10B981]">{{ $monthlyAccepted }}</p>
        <p class="text-sm text-gray-500 mt-2">Bulan ini</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-6">
    <!-- Recent Applications -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Lamaran Terbaru</h2>
            <a href="{{ route('hrd.pelamar') }}" class="text-purple-600 hover:text-purple-700 text-sm">Lihat Semua</a>
        </div>
        <div class="space-y-4">
            @foreach($recentApplications as $application)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                        {{ $application['initials'] }}
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $application['name'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $application['position'] }}</p>
                    </div>
                </div>
                @php
                    $statusColor = match($application['status']) {
                        'pending' => 'purple',
                        'review' => 'purple',
                        'wawancara' => 'pink',
                        'diterima' => 'green',
                        'ditolak' => 'red',
                        default => 'gray'
                    };
                    $statusText = match($application['status']) {
                        'pending' => 'Pending',
                        'review' => 'Review',
                        'wawancara' => 'Interview',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                        default => 'Unknown'
                    };
                @endphp
                <span class="px-3 py-1 text-sm rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700">
                    {{ $statusText }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Interview Schedule -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Jadwal Wawancara</h2>
            <a href="{{ route('hrd.wawancara') }}" class="text-purple-600 hover:text-purple-700 text-sm">Lihat Semua</a>
        </div>
        <div class="space-y-4">
            @foreach($upcomingInterviews as $interview)
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-medium text-gray-900">{{ $interview['name'] }}</h3>
                    <span class="text-sm text-gray-500">{{ $interview['schedule'] }}</span>
                </div>
                <p class="text-sm text-gray-600">{{ $interview['position'] }}</p>
                <div class="mt-2 flex items-center space-x-4">
                    <button class="text-purple-600 hover:text-purple-700 text-sm">Detail</button>
                    <button class="text-gray-600 hover:text-gray-700 text-sm">Reschedule</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Job Postings Overview -->
<div class="mt-6 bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Overview Lowongan</h2>
        <a href="{{ route('hrd.lowongan') }}" class="text-purple-600 hover:text-purple-700 text-sm">Kelola Lowongan</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-gray-500 text-sm">
                    <th class="pb-4">Posisi</th>
                    <th class="pb-4">Total Pelamar</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Deadline</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($jobPostings as $job)
                <tr class="border-t">
                    <td class="py-4">{{ $job['position'] }}</td>
                    <td>{{ $job['applicants'] }}</td>
                    <td>
                        <span class="px-3 py-1 text-sm rounded-full {{ $job['status'] === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $job['status'] }}
                        </span>
                    </td>
                    <td>{{ $job['deadline'] }}</td>
                    <td>
                        <button class="text-purple-600 hover:text-purple-700">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 