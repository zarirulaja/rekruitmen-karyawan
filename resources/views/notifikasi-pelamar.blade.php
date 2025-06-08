@extends('layouts.pelamar')

@section('title', 'Notifikasi')

@section('header', 'Notifikasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Notification Filters -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('notifikasi') }}" class="px-4 py-2 {{ !request('type') ? 'text-purple-600 border-b-2 border-purple-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                Semua
                @if($unreadCounts['all'] > 0)
                <span class="ml-1 px-2 py-0.5 text-xs bg-purple-100 text-purple-800 rounded-full">{{ $unreadCounts['all'] }}</span>
                @endif
            </a>
            <a href="{{ route('notifikasi', ['type' => 'lamaran']) }}" class="px-4 py-2 {{ request('type') == 'lamaran' ? 'text-purple-600 border-b-2 border-purple-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                Lamaran
                @if($unreadCounts['lamaran'] > 0)
                <span class="ml-1 px-2 py-0.5 text-xs bg-purple-100 text-purple-800 rounded-full">{{ $unreadCounts['lamaran'] }}</span>
                @endif
            </a>
            <a href="{{ route('notifikasi', ['type' => 'wawancara']) }}" class="px-4 py-2 {{ request('type') == 'wawancara' ? 'text-purple-600 border-b-2 border-purple-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                Wawancara
                @if($unreadCounts['wawancara'] > 0)
                <span class="ml-1 px-2 py-0.5 text-xs bg-purple-100 text-purple-800 rounded-full">{{ $unreadCounts['wawancara'] }}</span>
                @endif
            </a>
            <a href="{{ route('notifikasi', ['type' => 'lowongan']) }}" class="px-4 py-2 {{ request('type') == 'lowongan' ? 'text-purple-600 border-b-2 border-purple-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                Lowongan
                @if($unreadCounts['lowongan'] > 0)
                <span class="ml-1 px-2 py-0.5 text-xs bg-purple-100 text-purple-800 rounded-full">{{ $unreadCounts['lowongan'] }}</span>
                @endif
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
        {{ session('success') }}
    </div>
    @endif

    <!-- Mark All as Read Button -->
    @if($unreadCounts[request('type') ? request('type') : 'all'] > 0)
    <div class="flex justify-end mb-4">
        <form action="{{ route('notifikasi.read-all', ['type' => request('type')]) }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-purple-600 hover:text-purple-800">
                Tandai semua telah dibaca
            </button>
        </form>
    </div>
    @endif

    <!-- Notifications List -->
    <div class="space-y-4">
        @forelse($notifications as $notification)
        <div class="bg-white rounded-lg shadow-sm p-6 {{ !$notification->is_read ? 'border-l-4 border-purple-500' : '' }}">
            <div class="flex items-start">
                @if($notification->type == 'wawancara')
                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center text-pink-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @elseif($notification->type == 'lamaran')
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                @elseif($notification->type == 'lowongan')
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900">{{ $notification->title }}</h3>
                        <span class="text-sm text-gray-500">{{ $notification->time_ago }}</span>
                    </div>
                    <p class="text-gray-600 mt-1">
                        {!! $notification->message !!}
                    </p>
                    
                    @if($notification->data && isset($notification->data['details']))
                    <div class="mt-2 p-3 bg-gray-50 rounded-lg">
                        @foreach($notification->data['details'] as $key => $value)
                        <p class="{{ $loop->first ? 'text-gray-900 font-medium' : 'text-gray-600 text-sm mt-1' }}">{{ $value }}</p>
                        @endforeach
                    </div>
                    @elseif($notification->type == 'lamaran')
                    <div class="mt-2 p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-900 font-medium">Status Lamaran Diperbarui</p>
                        <p class="text-gray-600 text-sm mt-1">Status lamaran Anda telah diperbarui. Silakan periksa detail lamaran untuk informasi lebih lanjut.</p>
                    </div>
                    @elseif($notification->type == 'wawancara')
                    <div class="mt-2 p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-900 font-medium">Jadwal Wawancara</p>
                        <p class="text-gray-600 text-sm mt-1">Anda telah dijadwalkan untuk wawancara. Mohon hadir tepat waktu sesuai jadwal yang ditentukan.</p>
                    </div>
                    @endif
                    
                    <div class="mt-4 flex items-center space-x-4">
                        @if($notification->type == 'lowongan' && $notification->related_id)
                        <a href="{{ route('detail-lowongan', ['id' => $notification->related_id]) }}" class="text-purple-600 hover:text-purple-700 font-medium">
                            Lihat Lowongan
                        </a>
                        @endif
                        
                        @if(!$notification->is_read)
                        <form action="{{ route('notifikasi.read', ['id' => $notification->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-700">
                                Tandai telah dibaca
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="text-gray-500 mb-4">Tidak ada notifikasi untuk ditampilkan</p>
            <a href="{{ route('lowongan') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                Cari Lowongan
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->count() > 0)
    <div class="mt-8">
        {{ $notifications->appends(['type' => request('type')])->links() }}
    </div>
    @endif
</div>
@endsection 