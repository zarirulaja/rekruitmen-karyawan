@extends('layouts.pelamar')

@section('title', 'Profil Saya')

@section('header', 'Profil Saya')

@section('styles')
<style>
    /* Modal Centering */
    #konfirmasi-modal {
        display: none;
        align-items: center;
        justify-content: center;
    }
    
    #konfirmasi-modal .bg-white {
        margin: auto;
        position: relative;
        top: 0;
        transform: translateY(0);
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column - Profile Info -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="text-center">
                <div class="w-32 h-32 mx-auto bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-4xl font-semibold mb-4">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <h2 class="text-xl font-semibold text-gray-900">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">{{ $pelamar->posisi ?? 'Pelamar' }}</p>
            </div>

            <div class="mt-6 space-y-4">
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ Auth::user()->email }}</span>
                </div>
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>{{ $pelamar->telepon }}</span>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Alamat</h3>
                    <button type="button" onclick="showAlamatEdit()" class="text-purple-600 hover:text-purple-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span id="alamat-display">{{ $pelamar->alamat ?: 'Belum diisi' }}</span>
                </div>
                
                <div id="alamat-edit" class="hidden mt-2">
                    <form id="alamat-form">
                        <textarea id="alamat" name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3" placeholder="Masukkan alamat lengkap Anda">{{ $pelamar->alamat }}</textarea>
                        <div class="flex justify-end mt-2">
                            <button type="button" onclick="cancelAlamatEdit()" class="px-3 py-1 mr-2 text-gray-600 hover:text-gray-800">Batal</button>
                            <button type="button" onclick="saveAlamat()" class="px-3 py-1 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Keahlian</h3>
                    <button type="button" onclick="showSkillEdit()" class="text-purple-600 hover:text-purple-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                </div>
                <div id="skills-display" class="flex flex-wrap gap-2">
                    @if($pelamar->skill)
                        @foreach(explode(',', $pelamar->skill) as $skill)
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">{{ trim($skill) }}</span>
                        @endforeach
                    @else
                        <span class="text-gray-500">Belum ada keahlian yang ditambahkan</span>
                    @endif
                </div>
                
                <div id="skills-edit" class="hidden mt-2">
                    <form id="skills-form">
                        <textarea id="skill" name="skill" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3" placeholder="Masukkan keahlian Anda (pisahkan dengan koma)">{{ $pelamar->skill }}</textarea>
                        <div class="flex justify-end mt-2">
                            <button type="button" onclick="cancelSkillEdit()" class="px-3 py-1 mr-2 text-gray-600 hover:text-gray-800">Batal</button>
                            <button type="button" onclick="saveSkill()" class="px-3 py-1 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Experience & Education -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Experience -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Pengalaman Kerja</h2>
                <button type="button" onclick="showPengalamanEdit()" class="text-purple-600 hover:text-purple-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </button>
            </div>

            <div id="pengalaman-display" class="space-y-6">
                @if($pelamar->pengalaman_kerja)
                    {!! nl2br(e($pelamar->pengalaman_kerja)) !!}
                @else
                    <p class="text-gray-500">Belum ada pengalaman kerja yang ditambahkan</p>
                @endif
                </div>

            <div id="pengalaman-edit" class="hidden mt-4">
                <form id="pengalaman-form">
                    <textarea id="pengalaman_kerja" name="pengalaman_kerja" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" rows="6" placeholder="Deskripsikan pengalaman kerja Anda">{{ $pelamar->pengalaman_kerja }}</textarea>
                    <div class="flex justify-end mt-2">
                        <button type="button" onclick="cancelPengalamanEdit()" class="px-3 py-1 mr-2 text-gray-600 hover:text-gray-800">Batal</button>
                        <button type="button" onclick="savePengalaman()" class="px-3 py-1 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                </div>
                </form>
            </div>
        </div>

        <!-- Education -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Pendidikan</h2>
                <button type="button" onclick="showPendidikanEdit()" class="text-purple-600 hover:text-purple-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </button>
            </div>

            <div id="pendidikan-display" class="space-y-6">
                <div class="border-l-2 border-purple-500 pl-4">
                    <h3 id="pendidikan-jurusan" class="font-semibold text-gray-900">{{ $pelamar->pendidikan_terakhir }} {{ $pelamar->jurusan }}</h3>
                    <p id="pendidikan-universitas" class="text-gray-500 text-sm">{{ $pelamar->universitas }} • {{ $pelamar->tahun_lulus > 0 ? $pelamar->tahun_lulus : 'Tahun belum diisi' }}</p>
                </div>
            </div>
            
            <div id="pendidikan-edit" class="hidden mt-4">
                <form id="pendidikan-form" class="space-y-3">
                    <div>
                        <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                        <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="" {{ $pelamar->pendidikan_terakhir == '' ? 'selected' : '' }}>Pilih Pendidikan</option>
                            <option value="SMA/SMK" {{ $pelamar->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ $pelamar->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ $pelamar->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ $pelamar->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ $pelamar->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <input type="text" id="jurusan" name="jurusan" value="{{ $pelamar->jurusan }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Jurusan">
                    </div>
                    <div>
                        <label for="universitas" class="block text-sm font-medium text-gray-700 mb-1">Universitas/Sekolah</label>
                        <input type="text" id="universitas" name="universitas" value="{{ $pelamar->universitas }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Nama Universitas atau Sekolah">
                    </div>
                    <div>
                        <label for="tahun_lulus" class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus</label>
                        <input type="number" id="tahun_lulus" name="tahun_lulus" value="{{ $pelamar->tahun_lulus > 0 ? $pelamar->tahun_lulus : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Tahun Lulus">
                    </div>
                    <div class="flex justify-end mt-2">
                        <button type="button" onclick="cancelPendidikanEdit()" class="px-3 py-1 mr-2 text-gray-600 hover:text-gray-800">Batal</button>
                        <button type="button" onclick="savePendidikan()" class="px-3 py-1 bg-purple-600 text-white rounded-md hover:bg-purple-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- CV & Documents -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Dokumen</h2>
                <button type="button" onclick="$('#cv-upload').click()" class="text-purple-600 hover:text-purple-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
            </div>
            
            <form id="dokumen-form" enctype="multipart/form-data">
                <input type="file" id="cv-upload" name="cv_file" class="hidden" accept=".pdf,.doc,.docx">
            </form>

            <div id="dokumen-list" class="space-y-4">
                @if($pelamar->cv_path)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div class="ml-4">
                            <h3 class="font-medium text-gray-900">{{ basename($pelamar->cv_path) }}</h3>
                            <p class="text-sm text-gray-500">Diunggah {{ date('d F Y', strtotime($pelamar->updated_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button type="button" onclick="deleteDocument()" class="text-red-600 hover:text-red-700">Hapus</button>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada dokumen yang diunggah</p>
                    <button type="button" onclick="$('#cv-upload').click()" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Unggah CV</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast-notification" class="fixed top-4 right-4 z-50 transform transition-transform duration-300 ease-in-out translate-x-full">
    <div class="bg-white rounded-lg shadow-lg p-4 max-w-md w-full border-l-4 border-purple-600 flex items-center">
        <div class="flex-shrink-0 text-purple-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="ml-3">
            <p id="toast-message" class="text-sm font-medium text-gray-900">Perubahan berhasil disimpan!</p>
        </div>
        <div class="ml-auto">
            <button type="button" onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Konfirmasi Modal -->
<div id="konfirmasi-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-black bg-opacity-50 absolute inset-0" onclick="$('#konfirmasi-modal').fadeOut(200)"></div>
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full relative z-10 transform transition-all duration-300 ease-in-out scale-100 mx-auto" style="max-width: 90%; width: 450px;">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-purple-700" id="modal-title">Simpan Perubahan</h3>
            <button type="button" onclick="$('#konfirmasi-modal').fadeOut(200)" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <p class="text-gray-600 mb-6" id="modal-message">Apakah Anda yakin ingin menyimpan perubahan ini?</p>
        <div class="flex justify-end space-x-3">
            <button type="button" id="cancel-modal" class="px-4 py-2 text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
            <button type="button" id="confirm-modal" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">Simpan</button>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // CSRF Token untuk AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Toast notification functions
    function showToast(message) {
        $('#toast-message').text(message);
        $('#toast-notification').removeClass('translate-x-full').addClass('translate-x-0');
        
        // Auto hide after 3 seconds
        setTimeout(function() {
            hideToast();
        }, 3000);
    }
    
    function hideToast() {
        $('#toast-notification').removeClass('translate-x-0').addClass('translate-x-full');
    }
    
    // Konfirmasi modal functions
    function showModal(title, message, confirmCallback) {
        $('#modal-title').text(title);
        $('#modal-message').text(message);
        
        $('#confirm-modal').off('click').on('click', confirmCallback);
        $('#cancel-modal').off('click').on('click', function() {
            $('#konfirmasi-modal').fadeOut(200);
        });
        
        // Position modal in center
        const windowHeight = $(window).height();
        const modalHeight = $('.bg-white', '#konfirmasi-modal').outerHeight();
        if (modalHeight < windowHeight) {
            // Fix vertical position if modal is smaller than window
            $('.bg-white', '#konfirmasi-modal').css({
                'margin-top': 'auto',
                'margin-bottom': 'auto'
            });
        }
        
        $('#konfirmasi-modal').fadeIn(200);
    }

    // ===== KEAHLIAN =====
    function showSkillEdit() {
        $('#skills-display').hide();
        $('#skills-edit').show();
    }
    
    function cancelSkillEdit() {
        $('#skills-edit').hide();
        $('#skills-display').show();
    }
    
    function saveSkill() {
        const skill = $('#skill').val();
        
        // Tampilkan modal konfirmasi
        showModal('Simpan Keahlian', 'Apakah Anda yakin ingin menyimpan perubahan pada keahlian Anda?', function() {
            $.ajax({
                url: '/profil/update-skill',
                type: 'POST',
                data: { skill: skill },
                success: function(response) {
                    $('#konfirmasi-modal').fadeOut(200);
                    
                    // Update tampilan keahlian
                    let skillsHtml = '';
                    if (skill) {
                        const skills = skill.split(',');
                        for (let s of skills) {
                            if (s.trim()) {
                                skillsHtml += `<span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">${s.trim()}</span>`;
                            }
                        }
                    } else {
                        skillsHtml = '<span class="text-gray-500">Belum ada keahlian yang ditambahkan</span>';
                    }
                    
                    $('#skills-display').html(skillsHtml);
                    cancelSkillEdit();
                    
                    // Tampilkan toast notification
                    showToast('Keahlian berhasil disimpan!');
                },
                error: function(xhr) {
                    $('#konfirmasi-modal').fadeOut(200);
                    showToast('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    }
    
    // ===== ALAMAT =====
    function showAlamatEdit() {
        $('#alamat-display').hide();
        $('#alamat-edit').show();
    }
    
    function cancelAlamatEdit() {
        $('#alamat-edit').hide();
        $('#alamat-display').show();
    }
    
    function saveAlamat() {
        const alamat = $('#alamat').val();
        
        // Tampilkan modal konfirmasi
        showModal('Simpan Alamat', 'Apakah Anda yakin ingin menyimpan perubahan pada alamat Anda?', function() {
            $.ajax({
                url: '/profil/update-alamat',
                type: 'POST',
                data: { alamat: alamat },
                success: function(response) {
                    $('#konfirmasi-modal').fadeOut(200);
                    
                    // Update tampilan alamat
                    $('#alamat-display').text(alamat || 'Belum diisi');
                    cancelAlamatEdit();
                    
                    // Tampilkan toast notification
                    showToast('Alamat berhasil disimpan!');
                },
                error: function(xhr) {
                    $('#konfirmasi-modal').fadeOut(200);
                    showToast('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    }
    
    // ===== PENGALAMAN KERJA =====
    function showPengalamanEdit() {
        $('#pengalaman-display').hide();
        $('#pengalaman-edit').show();
    }
    
    function cancelPengalamanEdit() {
        $('#pengalaman-edit').hide();
        $('#pengalaman-display').show();
    }
    
    function savePengalaman() {
        const pengalaman = $('#pengalaman_kerja').val();
        
        // Tampilkan modal konfirmasi
        showModal('Simpan Pengalaman Kerja', 'Apakah Anda yakin ingin menyimpan perubahan pada pengalaman kerja Anda?', function() {
            $.ajax({
                url: '/profil/update-pengalaman',
                type: 'POST',
                data: { pengalaman_kerja: pengalaman },
                success: function(response) {
                    $('#konfirmasi-modal').fadeOut(200);
                    
                    // Update tampilan pengalaman
                    if (pengalaman) {
                        const formatted = pengalaman.replace(/\n/g, '<br>');
                        $('#pengalaman-display').html(formatted);
                    } else {
                        $('#pengalaman-display').html('<p class="text-gray-500">Belum ada pengalaman kerja yang ditambahkan</p>');
                    }
                    
                    cancelPengalamanEdit();
                    
                    // Tampilkan toast notification
                    showToast('Pengalaman kerja berhasil disimpan!');
                },
                error: function(xhr) {
                    $('#konfirmasi-modal').fadeOut(200);
                    showToast('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    }
    
    // ===== PENDIDIKAN =====
    function showPendidikanEdit() {
        $('#pendidikan-display').hide();
        $('#pendidikan-edit').show();
    }
    
    function cancelPendidikanEdit() {
        $('#pendidikan-edit').hide();
        $('#pendidikan-display').show();
    }
    
    function savePendidikan() {
        const pendidikan_terakhir = $('#pendidikan_terakhir').val();
        const jurusan = $('#jurusan').val();
        const universitas = $('#universitas').val();
        const tahun_lulus = $('#tahun_lulus').val();
        
        // Tampilkan modal konfirmasi
        showModal('Simpan Pendidikan', 'Apakah Anda yakin ingin menyimpan perubahan pada pendidikan Anda?', function() {
            $.ajax({
                url: '/profil/update-pendidikan',
                type: 'POST',
                data: { 
                    pendidikan_terakhir: pendidikan_terakhir,
                    jurusan: jurusan,
                    universitas: universitas,
                    tahun_lulus: tahun_lulus
                },
                success: function(response) {
                    $('#konfirmasi-modal').fadeOut(200);
                    
                    // Update tampilan pendidikan
                    $('#pendidikan-jurusan').text(pendidikan_terakhir + ' ' + jurusan);
                    $('#pendidikan-universitas').text(universitas + ' • ' + (tahun_lulus || 'Tahun belum diisi'));
                    
                    cancelPendidikanEdit();
                    
                    // Tampilkan toast notification
                    showToast('Pendidikan berhasil disimpan!');
                },
                error: function(xhr) {
                    $('#konfirmasi-modal').fadeOut(200);
                    showToast('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    }
    
    // ===== DOKUMEN =====
    $(document).ready(function() {
        $('#cv-upload').change(function() {
            if (this.files.length > 0) {
                // Tampilkan modal konfirmasi
                showModal('Unggah Dokumen', 'Apakah Anda yakin ingin mengunggah dokumen ini?', function() {
                    const formData = new FormData($('#dokumen-form')[0]);
                    
                    $.ajax({
                        url: '/profil/upload-cv',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#konfirmasi-modal').fadeOut(200);
                            
                            // Update tampilan dokumen
                            const fileName = $('#cv-upload')[0].files[0].name;
                            const today = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                            
                            const dokumenHtml = `
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div class="ml-4">
                                            <h3 class="font-medium text-gray-900">${fileName}</h3>
                                            <p class="text-sm text-gray-500">Diunggah ${today}</p>
                        </div>
                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="deleteDocument()" class="text-red-600 hover:text-red-700">Hapus</button>
                </div>
            </div>
                            `;
                            
                            $('#dokumen-list').html(dokumenHtml);
                            
                            // Tampilkan toast notification
                            showToast('Dokumen berhasil diunggah!');
                        },
                        error: function(xhr) {
                            $('#konfirmasi-modal').fadeOut(200);
                            showToast('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                });
            }
        });
    });
    
    // Fungsi untuk menghapus dokumen
    function deleteDocument() {
        // Tampilkan modal konfirmasi
        showModal('Hapus Dokumen', 'Apakah Anda yakin ingin menghapus dokumen ini?', function() {
            $.ajax({
                url: '/profil/delete-cv',
                type: 'POST',
                success: function(response) {
                    $('#konfirmasi-modal').fadeOut(200);
                    
                    // Update tampilan dokumen
                    const emptyDokumenHtml = `
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada dokumen yang diunggah</p>
                            <button type="button" onclick="$('#cv-upload').click()" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Unggah CV</button>
        </div>
                    `;
                    
                    $('#dokumen-list').html(emptyDokumenHtml);
                    
                    // Tampilkan toast notification
                    showToast('Dokumen berhasil dihapus!');
                },
                error: function(xhr) {
                    $('#konfirmasi-modal').fadeOut(200);
                    showToast('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    }
</script>
@endsection 