@extends('layouts.hrd')

@section('title', 'Data Pelamar')

@section('header', 'Data Pelamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Header with Actions -->
    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('hrd.pelamar') }}" method="GET" class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelamar..." 
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <select name="posisi" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">Semua Posisi</option>
                @foreach($positions as $position)
                    <option value="{{ $position }}" {{ request('posisi') == $position ? 'selected' : '' }}>
                        {{ $position }}
                    </option>
                @endforeach
            </select>
            <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Review</option>
                <option value="wawancara" {{ request('status') == 'wawancara' ? 'selected' : '' }}>Wawancara</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                Filter
            </button>
        </form>
        <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
            Export Data
        </button>
    </div>

    <!-- Applicants Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-gray-500 text-sm border-b">
                    <th class="pb-4">Pelamar</th>
                    <th class="pb-4">Posisi</th>
                    <th class="pb-4">Tanggal Lamar</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Progress</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse($pelamar as $lamaran)
                <tr class="border-b">
                    <td class="py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                                {{ $lamaran->initials }}
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $lamaran->pelamar->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $lamaran->pelamar->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4">{{ $lamaran->lowongan->posisi }}</td>
                    <td class="py-4">{{ $lamaran->formatted_date }}</td>
                    <td class="py-4">
                        <form action="{{ route('hrd.lamaran.update-status', $lamaran->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <select name="status" 
                                    onchange="this.form.submit()"
                                    class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent {{ $lamaran->status_class }}">
                                <option value="pending" {{ $lamaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="review" {{ $lamaran->status == 'review' ? 'selected' : '' }}>Review</option>
                                <option value="wawancara" {{ $lamaran->status == 'wawancara' ? 'selected' : '' }}>Wawancara</option>
                                <option value="diterima" {{ $lamaran->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $lamaran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </td>
                    <td class="py-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $lamaran->progress }}%"></div>
                        </div>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('hrd.pelamar.show', $lamaran->pelamar_id) }}" class="text-purple-600 hover:text-purple-700">Detail</a>
                            @if($lamaran->pelamar->cv_path)
                                <a href="{{ route('hrd.pelamar.download-cv', $lamaran->pelamar_id) }}" class="text-gray-600 hover:text-gray-700">CV</a>
                            @endif
                            @if($lamaran->pelamar->portfolio_url)
                                <a href="{{ $lamaran->pelamar->portfolio_url }}" target="_blank" class="text-gray-600 hover:text-gray-700">Portfolio</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">
                        Tidak ada data pelamar yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <p class="text-sm text-gray-500">
            Menampilkan {{ $pelamar->firstItem() ?? 0 }}-{{ $pelamar->lastItem() ?? 0 }} dari {{ $pelamar->total() }} pelamar
        </p>
        <div class="flex items-center space-x-2">
            {{ $pelamar->links() }}
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
    <span class="block sm:inline">{{ session('error') }}</span>
</div>
@endif

@push('scripts')
<script>
    // Auto-hide alerts after 3 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('[role="alert"]');
        alerts.forEach(alert => {
            alert.style.display = 'none';
        });
    }, 3000);
</script>
@endpush

@endsection 