@extends('layouts.hrd')

@section('title', 'Jadwal Wawancara')

@section('header', 'Jadwal Wawancara')

@section('content')
@if(session('schedule_interview_id'))
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    {{ session('success') ?: 'Silakan pilih tanggal di kalender untuk menjadwalkan wawancara.' }}
                </p>
            </div>
        </div>
    </div>
@endif
<div class="grid grid-cols-3 gap-6">
    <!-- Calendar Section -->
    <div class="col-span-2 bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Kalender Wawancara</h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('hrd.wawancara', ['filter' => 'today']) }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 {{ request('filter') == 'today' ? 'bg-purple-100 border-purple-300 text-purple-700' : '' }}">Hari Ini</a>
                <a href="{{ route('hrd.wawancara', ['filter' => 'week']) }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 {{ request('filter') == 'week' ? 'bg-purple-100 border-purple-300 text-purple-700' : '' }}">Minggu Ini</a>
                <a href="{{ route('hrd.wawancara', ['filter' => 'month']) }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 {{ request('filter') == 'month' ? 'bg-purple-100 border-purple-300 text-purple-700' : '' }}">Bulan Ini</a>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-2 mb-4">
            <div class="text-center text-sm text-gray-500 py-2">Min</div>
            <div class="text-center text-sm text-gray-500 py-2">Sen</div>
            <div class="text-center text-sm text-gray-500 py-2">Sel</div>
            <div class="text-center text-sm text-gray-500 py-2">Rab</div>
            <div class="text-center text-sm text-gray-500 py-2">Kam</div>
            <div class="text-center text-sm text-gray-500 py-2">Jum</div>
            <div class="text-center text-sm text-gray-500 py-2">Sab</div>
        </div>

        <div class="grid grid-cols-7 gap-2">
            <!-- Calculate calendar days based on current month -->
            @php
                $currentDate = \Carbon\Carbon::now();
                $daysInMonth = $currentDate->daysInMonth;
                $firstDayOfMonth = \Carbon\Carbon::create($currentDate->year, $currentDate->month, 1);
                $startOfCalendar = $firstDayOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
                $endOfCalendar = $firstDayOfMonth->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SATURDAY);
                
                // Group interviews by date
                $interviewsByDate = [];
                foreach ($allInterviews ?? $wawancara as $interview) {
                    $date = \Carbon\Carbon::parse($interview->jadwal_wawancara)->format('Y-m-d');
                    if (!isset($interviewsByDate[$date])) {
                        $interviewsByDate[$date] = 0;
                    }
                    $interviewsByDate[$date]++;
                }
            @endphp

            <!-- Calendar Days -->
            @for ($day = $startOfCalendar->copy(); $day <= $endOfCalendar; $day->addDay())
                @php
                    $isCurrentMonth = $day->month === $currentDate->month;
                    $isToday = $day->isToday();
                    $dateKey = $day->format('Y-m-d');
                    $hasInterviews = isset($interviewsByDate[$dateKey]);
                    $interviewCount = $hasInterviews ? $interviewsByDate[$dateKey] : 0;
                    $isFutureDate = $day->startOfDay() >= now()->startOfDay();
                    $isSelectedDate = session('selected_date') === $dateKey;
                @endphp
                <div class="aspect-square border {{ $isCurrentMonth ? 'border-gray-200' : 'border-gray-100' }} rounded-lg p-2 
                    {{ $isToday ? 'bg-purple-50 border-purple-200' : ($isSelectedDate ? 'bg-purple-100 border-purple-300' : ($isCurrentMonth ? '' : 'bg-gray-50')) }}
                    {{ $isFutureDate && $isCurrentMonth ? 'cursor-pointer hover:bg-purple-50 hover:border-purple-200' : '' }}"
                    @if($isFutureDate && $isCurrentMonth)
                        onclick="selectDate('{{ $dateKey }}')" 
                        data-date="{{ $dateKey }}"
                    @endif
                >
                    <div class="text-sm {{ $isCurrentMonth ? 'text-gray-600' : 'text-gray-400' }} mb-1">{{ $day->day }}</div>
                    @if ($hasInterviews)
                        <div class="text-xs text-purple-600">{{ $interviewCount }} Wawancara</div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <!-- Upcoming Interviews -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Wawancara Hari Ini</h2>
            <a href="{{ route('hrd.wawancara', ['filter' => 'today']) }}" class="text-purple-600 hover:text-purple-700 text-sm">Lihat Semua</a>
        </div>

        <div class="space-y-4">
            @php
                $todayInterviews = $wawancara->filter(function($interview) {
                    return \Carbon\Carbon::parse($interview->jadwal_wawancara)->isToday();
                });
            @endphp

            @if($todayInterviews->count() > 0)
                @foreach($todayInterviews as $interview)
                    <div class="p-4 {{ \Carbon\Carbon::parse($interview->jadwal_wawancara)->isFuture() ? 'bg-purple-50 border border-purple-100' : 'bg-gray-50' }} rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-medium text-gray-900">{{ $interview->pelamar->user->name ?? 'Nama tidak tersedia' }}</h3>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($interview->jadwal_wawancara)->format('H:i') }}</span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $interview->lowongan->posisi ?? 'Posisi tidak tersedia' }}</p>
                        <div class="mt-2">
                            <button class="text-purple-600 hover:text-purple-700 text-sm" onclick="showInterviewDetails({{ $interview->id }})">Detail</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-4 bg-gray-50 rounded-lg text-center">
                    <p class="text-gray-600">Tidak ada wawancara yang dijadwalkan untuk hari ini.</p>
                </div>
            @endif
        </div>

        </div>
        

    </div>
</div>

<!-- Interview Details Modal (Hidden by default) -->
<div class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="interviewModal">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Wawancara</h3>
            <div class="space-y-4" id="interviewDetails">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pelamar</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-pelamar"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Posisi</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-posisi"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-jadwal"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-lokasi"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Interviewer</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-interviewer"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Catatan</label>
                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line" id="modal-catatan"></p>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeInterviewModal()" class="px-4 py-2 text-sm text-white bg-purple-600 rounded-lg hover:bg-purple-700">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Interview data from the database
    const interviewData = {
        @foreach($wawancara as $interview)
        {{ $interview->id }}: {
            id: {{ $interview->id }},
            pelamar: "{{ $interview->pelamar->user->name ?? 'Nama tidak tersedia' }}",
            posisi: "{{ $interview->lowongan->posisi ?? 'Posisi tidak tersedia' }}",
            jadwal: "{{ \Carbon\Carbon::parse($interview->jadwal_wawancara)->format('d F Y, H:i') }} WIB",
            lokasi: "{{ $interview->lokasi_wawancara ?? ($interview->catatan_hrd ?: 'Belum ditentukan') }}",
            interviewer: "{{ $interview->interviewer ?? 'Belum ditentukan' }}",
            catatan: "{{ $interview->catatan_wawancara ?? '-' }}"
        },
        @endforeach
    };

    function showInterviewDetails(interviewId) {
        const interview = interviewData[interviewId];
        if (interview) {
            document.getElementById('modal-pelamar').textContent = interview.pelamar;
            document.getElementById('modal-posisi').textContent = interview.posisi;
            document.getElementById('modal-jadwal').textContent = interview.jadwal;
            document.getElementById('modal-lokasi').textContent = interview.lokasi;
            document.getElementById('modal-interviewer').textContent = interview.interviewer;
            document.getElementById('modal-catatan').textContent = interview.catatan;
            document.getElementById('interviewModal').classList.remove('hidden');
        }
    }

    function closeInterviewModal() {
        document.getElementById('interviewModal').classList.add('hidden');
    }
    // Function to format date in Indonesian format
    function formatDateIndonesian(dateString) {
        const date = new Date(dateString);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('id-ID', options);
    }
    
    // Function to handle date selection for interview scheduling
    function selectDate(date) {
        // Check if we're in scheduling mode
        const scheduleInterviewId = '{{ session("schedule_interview_id") }}';
        console.log('scheduleInterviewId:', scheduleInterviewId);
        console.log('Selected date:', date);
        
        if (scheduleInterviewId) {
            // Show scheduling modal with the selected date
            document.getElementById('schedule-date').value = date;
            
            // Display formatted date in the modal
            const formattedDate = formatDateIndonesian(date);
            document.getElementById('selected-date-display').textContent = 'Tanggal: ' + formattedDate;
            
            // Update form action URL - pastikan URL sesuai dengan route yang ada
            const form = document.getElementById('scheduleForm');
            form.action = '{{ url("hrd/lamaran") }}/' + scheduleInterviewId + '/schedule-interview';
            
            // Log untuk debugging
            console.log('Form action set to: ' + form.action);
            
            document.getElementById('scheduleModal').classList.remove('hidden');
        } else {
            // Just filter interviews by date
            window.location.href = '{{ route("hrd.wawancara") }}?date=' + date;
        }
    }

    // Function to close the scheduling modal
    function closeScheduleModal() {
        document.getElementById('scheduleModal').classList.add('hidden');
    }
    
    // Function to handle form submission
    function submitScheduleForm(event) {
        event.preventDefault();
        
        // Get form and form data
        const form = document.getElementById('schedule-form');
        const scheduleInterviewId = '{{ session("schedule_interview_id") }}';
        const date = document.getElementById('schedule-date').value;
        const time = document.getElementById('interview_time').value;
        const lokasi = document.getElementById('lokasi_wawancara').value;
        const interviewer = document.getElementById('interviewer').value;
        const catatan = document.getElementById('catatan').value;
        
        // Log form data for debugging
        console.log('Form data:', {
            id: scheduleInterviewId,
            date: date,
            time: time,
            lokasi: lokasi,
            interviewer: interviewer,
            catatan: catatan
        });
        
        // Create form data object
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('interview_date', date);
        formData.append('interview_time', time);
        formData.append('lokasi_wawancara', lokasi);
        formData.append('interviewer', interviewer);
        formData.append('catatan', catatan);
        
        // Send AJAX request
        fetch('{{ url("hrd/lamaran") }}/' + scheduleInterviewId + '/schedule-interview', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                return response.json().then(data => {
                    console.error('Error response:', data);
                    throw new Error('Server responded with status: ' + response.status + (data.message ? '\n' + data.message : ''));
                }).catch(err => {
                    // Jika response bukan JSON
                    throw new Error('Server responded with status: ' + response.status);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Success response:', data);
            // Tutup modal
            const modal = document.getElementById('scheduleModal');
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            
            // Tampilkan pesan sukses
            alert(data.message);
            
            // Reload halaman untuk menampilkan jadwal baru
            window.location.reload();
        })
        .catch(error => {
            // Tampilkan pesan error
            alert('Terjadi kesalahan saat menjadwalkan wawancara: ' + error.message);
            console.error('Error:', error);
        })
        .finally(() => {
            // Reset loading state
            document.getElementById('submitBtn').disabled = false;
            document.getElementById('submitBtn').innerHTML = 'Jadwalkan';
        });
        
        return false; // Prevent form submission
    }
</script>
@endsection

<!-- Interview Scheduling Modal (Hidden by default) -->
<div class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="scheduleModal">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Jadwalkan Wawancara</h3>
            <p class="text-sm text-gray-600 mb-4" id="selected-date-display"></p>
            <form method="POST" id="scheduleForm" onsubmit="return submitScheduleForm()">
                @csrf
                <input type="hidden" name="interview_date" id="schedule-date">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Wawancara</label>
                    <input type="time" name="interview_time" id="interview_time" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Wawancara</label>
                    <input type="text" name="lokasi_wawancara" id="lokasi_wawancara" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Contoh: Ruang Meeting Lantai 3 atau Zoom Meeting">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Interviewer</label>
                    <input type="text" name="interviewer" id="interviewer" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Nama interviewer">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea name="catatan" id="catatan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" rows="3" placeholder="Catatan tambahan untuk wawancara"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeScheduleModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Jadwalkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 