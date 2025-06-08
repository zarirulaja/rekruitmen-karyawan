@extends('layouts.pelamar')

@section('title', $lowongan->judul)

@section('header', 'Detail Lowongan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Left Column - Job Details -->
    <div class="space-y-6">
        <!-- Job Header -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 font-semibold">
                    {{ strtoupper(substr($lowongan->posisi, 0, 2)) }}
                </div>
                <div class="flex-1">
                    <h1 class="text-2xl font-semibold text-gray-900">{{ $lowongan->judul }}</h1>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-full">{{ $lowongan->tipe_pekerjaan }}</span>
                        <span class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-full">{{ $lowongan->lokasi }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Details -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm text-gray-500 mb-1">Gaji:</h3>
                    <p class="font-semibold">
                        @if($lowongan->gaji_min && $lowongan->gaji_max)
                            Rp {{ number_format($lowongan->gaji_min / 1000000, 0) }}-{{ number_format($lowongan->gaji_max / 1000000, 0) }} juta/bulan
                        @else
                            Gaji Dirahasiakan
                        @endif
                    </p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 mb-1">Posisi:</h3>
                    <p class="font-semibold">{{ $lowongan->posisi }}</p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 mb-1">Tanggal Posting:</h3>
                    <p class="font-semibold">{{ $lowongan->created_at->format('d F Y') }}</p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 mb-1">Deadline Apply:</h3>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($lowongan->tanggal_tutup)->format('d F Y') }}</p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 mb-1">Tipe Pekerjaan:</h3>
                    <p class="font-semibold">{{ $lowongan->tipe_pekerjaan }}</p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 mb-1">Lokasi:</h3>
                    <p class="font-semibold">{{ $lowongan->lokasi }}</p>
                </div>
            </div>

            <!-- Job Description -->
            <div class="space-y-6">
                <div>
                    <h2 class="text-lg font-semibold mb-3">Deskripsi Pekerjaan</h2>
                    <p class="text-gray-600 mb-4">
                        {!! nl2br(e($lowongan->deskripsi)) !!}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold mb-2">Tanggung Jawab:</h3>
                    <div class="text-gray-600">
                        {!! nl2br(e($lowongan->tanggung_jawab)) !!}
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold mb-2">Kualifikasi:</h3>
                    <div class="text-gray-600">
                        {!! nl2br(e($lowongan->persyaratan)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Application Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-6">Form Lamaran</h2>
        
        @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
            {{ session('error') }}
        </div>
        @endif
        
        <!-- Check if user has a pelamar profile -->
        @php
            $pelamar = Auth::user()->pelamar;
            $hasCV = $pelamar && !empty($pelamar->cv_path);
            
            // Check if already applied
            $alreadyApplied = false;
            if ($pelamar) {
                $alreadyApplied = App\Models\Lamaran::where('pelamar_id', $pelamar->id)
                                  ->where('lowongan_id', $lowongan->id)
                                  ->exists();
            }
        @endphp
        
        @if ($alreadyApplied)
        <div class="p-6 bg-yellow-50 border border-yellow-100 rounded-lg text-center">
            <svg class="w-12 h-12 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <h3 class="text-lg font-medium text-yellow-800 mb-2">Anda sudah melamar untuk posisi ini</h3>
            <p class="text-yellow-700">Anda dapat melihat status lamaran di halaman <a href="{{ route('lamaran-saya') }}" class="font-medium underline">Lamaran Saya</a>.</p>
        </div>
        @elseif (!$pelamar)
        <div class="p-6 bg-yellow-50 border border-yellow-100 rounded-lg text-center">
            <svg class="w-12 h-12 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <h3 class="text-lg font-medium text-yellow-800 mb-2">Lengkapi profil Anda terlebih dahulu</h3>
            <p class="text-yellow-700 mb-4">Untuk dapat melamar, Anda perlu melengkapi profil dan mengunggah CV.</p>
            <a href="{{ route('profil') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Lengkapi Profil</a>
        </div>
        @else
        <form action="{{ route('lowongan.apply', ['id' => $lowongan->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" 
                       value="{{ Auth::user()->name }}"
                       disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" 
                       value="{{ Auth::user()->email }}"
                       disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="tel" 
                       value="{{ Auth::user()->pelamar->telepon ?? 'Belum diisi' }}"
                       disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CV</label>
                @if($hasCV)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div class="ml-4">
                            <h3 class="font-medium text-gray-900">{{ basename($pelamar->cv_path) }}</h3>
                            <p class="text-sm text-gray-500">CV dari profil Anda akan digunakan</p>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="use_profile_cv" value="1">
                @else
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                    <div class="space-y-4">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Unggah CV Anda</h3>
                            <p class="mt-1 text-xs text-gray-500">PDF, DOC, atau DOCX (maks. 5MB)</p>
                        </div>
                        
                        <div class="relative border rounded-md p-2">
                            <input id="file-upload" name="file-upload" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.doc,.docx" onchange="updateFileName(this)">
                            <div class="flex items-center justify-between">
                                <span id="file-name" class="text-sm text-gray-500">Belum ada file yang dipilih</span>
                                <button type="button" class="px-3 py-1 bg-purple-600 text-white text-sm rounded hover:bg-purple-700">
                                    Pilih File
                                </button>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-sm text-yellow-600">
                                CV yang Anda unggah akan disimpan di profil Anda
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan Tambahan (Opsional)</label>
                <textarea name="pesan_tambahan" rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                          placeholder="Tuliskan pesan tambahan untuk lamaran Anda..."></textarea>
            </div>

            <button type="submit" class="w-full px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium">
                Kirim Lamaran
            </button>
        </form>
        @endif
    </div>
</div>

@section('scripts')
<script>
    function updateFileName(input) {
        const fileName = input.files.length > 0 ? input.files[0].name : 'Belum ada file yang dipilih';
        document.getElementById('file-name').textContent = fileName;
    }
</script>
@endsection
@endsection 