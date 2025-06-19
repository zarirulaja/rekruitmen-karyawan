<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Winnicode HR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#7E3AF2] text-white">
            <!-- Logo -->
            <div class="p-4">
                <div class="flex items-center space-x-2">
                    <img src="/images/banner-logo.png" alt="Winnicode" class="h-8">
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-8">
                <a href="{{ route('hrd.dashboard') }}" class="flex items-center px-6 py-3 text-white/70 hover:bg-white/10 {{ request()->routeIs('hrd.dashboard') ? 'bg-white/10' : '' }}">
                    <span class="mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('hrd.lowongan') }}" class="flex items-center px-6 py-3 text-white/70 hover:bg-white/10 {{ request()->routeIs('hrd.lowongan') ? 'bg-white/10' : '' }}">
                    <span class="mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                    Kelola Lowongan
                </a>
                <a href="{{ route('hrd.pelamar') }}" class="flex items-center px-6 py-3 text-white/70 hover:bg-white/10 {{ request()->routeIs('hrd.pelamar') ? 'bg-white/10' : '' }}">
                    <span class="mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </span>
                    Data Pelamar
                </a>
                <a href="{{ route('hrd.wawancara') }}" class="flex items-center px-6 py-3 text-white/70 hover:bg-white/10 {{ request()->routeIs('hrd.wawancara') ? 'bg-white/10' : '' }}">
                    <span class="mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                    Jadwal Wawancara
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="mt-8 px-6">
                    @csrf
                    <button type="submit" class="flex items-center w-full py-3 text-white/70 hover:bg-white/10 hover:text-white">
                        <span class="mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </span>
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-semibold text-gray-800">@yield('header')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Profile" class="w-10 h-10 rounded-full">
                </div>
            </div>

            <!-- Content -->
            @yield('content')
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    <!-- Confirm Delete Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete confirmation
            document.body.addEventListener('submit', function(e) {
                if (e.target.matches('form[data-confirm-delete]')) {
                    e.preventDefault();
                    const form = e.target;
                    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#7E3AF2',
                        cancelButtonColor: '#6B7280',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });

            // Handle status change confirmation if needed
            const statusSelects = document.querySelectorAll('select[name="status"]');
            statusSelects.forEach(select => {
                select.addEventListener('change', function(e) {
                    const form = this.form;
                    const newStatus = this.value;
                    const currentStatus = this.querySelector(`option[value="${this.value}"][selected]`) ? this.value : null;
                    
                    if (newStatus === 'ditolak' || currentStatus === 'diterima') {
                        e.preventDefault();
                        
                        Swal.fire({
                            title: 'Konfirmasi Perubahan Status',
                            text: `Anda yakin ingin mengubah status menjadi ${this.options[this.selectedIndex].text}?`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#7E3AF2',
                            cancelButtonColor: '#6B7280',
                            confirmButtonText: 'Ya, ubah status',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else {
                                this.value = currentStatus || '';
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>