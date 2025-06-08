@extends('layouts.hrd')

@section('title', 'Detail Pelamar - ' . $pelamar->user->name)

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Detail Pelamar</h1>
        <a href="{{ route('hrd.pelamar') }}" class="text-purple-600 hover:text-purple-700">
            &larr; Kembali ke Daftar Pelamar
        </a>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Basic Information -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-start mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-xl font-semibold">
                    {{ substr($pelamar->user->name, 0, 2) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $pelamar->user->name }}</h2>
                    <p class="text-gray-500">{{ $pelamar->user->email }}</p>
                    @if($pelamar->telepon)
                        <p class="text-gray-500 mt-1">{{ $pelamar->telepon }}</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-4">
                @if($pelamar->cv_path)
                <a href="{{ route('hrd.pelamar.download-cv', $pelamar->id) }}" 
                   class="inline-flex items-center px-4 py-2 border border-purple-600 rounded-lg text-purple-600 hover:bg-purple-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download CV
                </a>
                @endif
                @if($pelamar->portfolio_url)
                <a href="{{ $pelamar->portfolio_url }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Portfolio
                </a>
                @endif
            </div>
        </div>

        @if($nextInterview)
        <div class="mb-6 p-4 bg-purple-50 rounded-lg border border-purple-100">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-purple-900">Jadwal Wawancara Mendatang</h3>
                    <div class="mt-2 text-purple-700">
                        <p class="text-sm">
                            <span class="font-medium">Posisi:</span> {{ $nextInterview->lowongan->posisi }}
                        </p>
                        <p class="text-sm">
                            <span class="font-medium">Waktu:</span> {{ $nextInterview->formatted_jadwal }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Personal Information -->
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Informasi Pribadi</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-500">Alamat</label>
                        <p class="text-gray-900">{{ $pelamar->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">No. Telepon</label>
                        <p class="text-gray-900">{{ $pelamar->telepon ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Keahlian</h3>
                <div class="flex flex-wrap gap-2">
                    @if($pelamar->skill)
                        @foreach(explode(',', $pelamar->skill) as $skill)
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">{{ trim($skill) }}</span>
                        @endforeach
                    @else
                        <p class="text-gray-500">Tidak ada keahlian yang tercatat</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Experience & Education -->
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Pengalaman</h3>
                <div class="space-y-4">
                    @if($pelamar->pengalaman_kerja)
                        @foreach(explode('|', $pelamar->pengalaman_kerja) as $pengalaman)
                            @php
                                $parts = explode(';', $pengalaman);
                                $posisi = $parts[0] ?? '';
                                $perusahaan = $parts[1] ?? '';
                                $periode = $parts[2] ?? '';
                            @endphp
                            <div class="border-l-2 border-purple-200 pl-4">
                                <h4 class="font-medium text-gray-900">{{ $posisi }}</h4>
                                <p class="text-gray-600">{{ $perusahaan }}</p>
                                <p class="text-sm text-gray-500">{{ $periode }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Tidak ada pengalaman yang tercatat</p>
                    @endif
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Pendidikan</h3>
                <div class="space-y-4">
                    <div class="border-l-2 border-purple-200 pl-4">
                        <h4 class="font-medium text-gray-900">{{ $pelamar->pendidikan_terakhir }}</h4>
                        <p class="text-gray-600">{{ $pelamar->universitas }}</p>
                        <p class="text-sm text-gray-600">{{ $pelamar->jurusan }}</p>
                        @if($pelamar->tahun_lulus)
                            <p class="text-sm text-gray-500">Lulus {{ $pelamar->tahun_lulus }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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