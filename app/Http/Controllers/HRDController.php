<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\Pelamar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\FileHelper;

class HRDController extends Controller
{
    public function dashboard()
    {
        // Get total job postings and monthly change
        $totalLowongan = Lowongan::count();
        $lastMonthLowongan = Lowongan::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', '=', Carbon::now()->subMonth()->year)
            ->count();
        $lowonganChange = $totalLowongan - $lastMonthLowongan;

        // Get total applicants and weekly change
        $totalPelamar = Lamaran::distinct('pelamar_id')->count('pelamar_id');
        $lastWeekPelamar = Lamaran::whereDate('created_at', '>=', Carbon::now()->subWeek())
            ->distinct('pelamar_id')
            ->count('pelamar_id');
        $pelamarChange = $lastWeekPelamar;

        // Get today's interviews count
        $todayInterviews = Lamaran::where('status', 'wawancara')
            ->whereDate('jadwal_wawancara', Carbon::today())
            ->count();

        // Get monthly accepted candidates
        $monthlyAccepted = Lamaran::where('status', 'diterima')
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->count();

        // Get recent applications
        $recentApplications = Lamaran::with(['pelamar.user', 'lowongan'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($lamaran) {
                return [
                    'name' => $lamaran->pelamar->user->name,
                    'position' => $lamaran->lowongan->posisi,
                    'status' => $lamaran->status,
                    'initials' => substr($lamaran->pelamar->user->name, 0, 2)
                ];
            });

        // Get upcoming interviews
        $upcomingInterviews = Lamaran::with(['pelamar.user', 'lowongan'])
            ->where('status', 'wawancara')
            ->whereDate('jadwal_wawancara', '>=', Carbon::today())
            ->orderBy('jadwal_wawancara')
            ->take(3)
            ->get()
            ->map(function ($lamaran) {
                return [
                    'name' => $lamaran->pelamar->user->name,
                    'position' => $lamaran->lowongan->posisi,
                    'schedule' => Carbon::parse($lamaran->jadwal_wawancara)->format('H:i')
                ];
            });

        // Get job postings overview
        $jobPostings = Lowongan::withCount('lamaran')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($lowongan) {
                return [
                    'position' => $lowongan->posisi,
                    'applicants' => $lowongan->lamaran_count,
                    'status' => $lowongan->status ? 'Aktif' : 'Ditutup',
                    'deadline' => Carbon::parse($lowongan->tanggal_tutup)->format('d M Y')
                ];
            });

        return view('hrd.dashboard', compact(
            'totalLowongan',
            'lowonganChange',
            'totalPelamar',
            'pelamarChange',
            'todayInterviews',
            'monthlyAccepted',
            'recentApplications',
            'upcomingInterviews',
            'jobPostings'
        ));
    }

    public function lowongan(Request $request)
    {
        $query = Lowongan::withCount('lamaran');

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('posisi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status) {
                case 'active':
                    $query->where('status', true)
                          ->where('tanggal_tutup', '>=', Carbon::today());
                    break;
                case 'closed':
                    $query->where(function($q) {
                        $q->where('status', false)
                          ->orWhere('tanggal_tutup', '<', Carbon::today());
                    });
                    break;
                case 'draft':
                    $query->where('status', false);
                    break;
            }
        }

        // Get paginated results
        $lowongan = $query->orderBy('created_at', 'desc')
                         ->paginate(10)
                         ->withQueryString();

        // Transform the data to include formatted dates and status text
        $lowongan->getCollection()->transform(function ($item) {
            $item->formatted_deadline = Carbon::parse($item->tanggal_tutup)->format('d M Y');
            $item->status_text = $item->status && $item->tanggal_tutup >= Carbon::today() ? 'Aktif' : 'Ditutup';
            return $item;
        });

        // Get total count for pagination info
        $total = $lowongan->total();
        $from = $lowongan->firstItem() ?? 0;
        $to = $lowongan->lastItem() ?? 0;

        return view('hrd.lowongan', compact('lowongan', 'total', 'from', 'to'));
    }

    public function createLowongan()
    {
        return view('hrd.lowongan.create');
    }

    public function storeLowongan(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'posisi' => 'required|string|max:255',
            'tipe_pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'persyaratan' => 'required|string',
            'tanggung_jawab' => 'required|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gt:gaji_min',
            'tanggal_tutup' => 'required|date|after:today',
            'status' => 'boolean',
        ]);

        $lowongan = Lowongan::create($validated);

        return redirect()
            ->route('hrd.lowongan.show', $lowongan->id)
            ->with('success', 'Lowongan berhasil dibuat!');
    }

    public function showLowongan($id)
    {
        try {
            // Find the job posting
            $lowongan = Lowongan::findOrFail($id);
            
            // Get paginated applications with eager loading
            $lamaran = Lamaran::with(['pelamar.user'])
                ->where('lowongan_id', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // Transform data to handle null relationships
            $lamaran->getCollection()->transform(function ($item) {
                // Set default values for missing relationships
                if (!$item->pelamar || !$item->pelamar->user) {
                    $item->pelamar = (object)[
                        'user' => (object)[
                            'name' => 'Data tidak tersedia',
                            'email' => '-'
                        ]
                    ];
                }

                // Ensure created_at is properly formatted
                $item->created_at = $item->created_at ? \Carbon\Carbon::parse($item->created_at) : null;
                
                // Set default status if null
                $item->status = $item->status ?? 'pending';

                return $item;
            });

            return view('hrd.lowongan.show', compact('lowongan', 'lamaran'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('hrd.lowongan')
                ->with('error', 'Lowongan tidak ditemukan.');
        } catch (\Exception $e) {
            \Log::error('Error in showLowongan', [
                'id' => $id,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            
            return redirect()
                ->route('hrd.lowongan')
                ->with('error', 'Terjadi kesalahan saat menampilkan detail lowongan. Silakan coba lagi nanti.');
        }
    }

    public function editLowongan($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('hrd.lowongan.edit', compact('lowongan'));
    }

    public function updateLowongan(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'posisi' => 'required|string|max:255',
            'tipe_pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'persyaratan' => 'required|string',
            'tanggung_jawab' => 'required|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gt:gaji_min',
            'tanggal_tutup' => 'required|date|after:today',
            'status' => 'boolean',
        ]);

        $lowongan->update($validated);

        return redirect()
            ->route('hrd.lowongan.show', $lowongan->id)
            ->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroyLowongan($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        
        // Check if there are any applications
        if ($lowongan->lamaran()->exists()) {
            return redirect()
                ->route('hrd.lowongan')
                ->with('error', 'Tidak dapat menghapus lowongan yang sudah memiliki lamaran.');
        }

        $lowongan->delete();

        return redirect()
            ->route('hrd.lowongan')
            ->with('success', 'Lowongan berhasil dihapus!');
    }

    public function pelamar(Request $request)
    {
        $query = Lamaran::with(['pelamar.user', 'lowongan'])
            ->select('lamaran.*')
            ->join('pelamar', 'lamaran.pelamar_id', '=', 'pelamar.id')
            ->join('users', 'pelamar.user_id', '=', 'users.id')
            ->join('lowongan', 'lamaran.lowongan_id', '=', 'lowongan.id');

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%");
            });
        }

        // Handle position filter
        if ($request->has('posisi') && !empty($request->posisi)) {
            $query->where('lowongan.posisi', $request->posisi);
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('lamaran.status', $request->status);
        }

        // Get paginated results
        $pelamar = $query->orderBy('lamaran.created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        // Get unique positions for filter dropdown
        $positions = Lowongan::distinct()->pluck('posisi');

        // Transform the data
        $pelamar->getCollection()->transform(function ($item) {
            $item->progress = match($item->status) {
                'pending' => 0,
                'review' => 25,
                'wawancara' => 50,
                'diterima' => 100,
                'ditolak' => 100,
                default => 0
            };

            $item->status_class = match($item->status) {
                'pending' => 'bg-gray-100 text-gray-700',
                'review' => 'bg-purple-100 text-purple-700',
                'wawancara' => 'bg-pink-100 text-pink-700',
                'diterima' => 'bg-green-100 text-green-700',
                'ditolak' => 'bg-red-100 text-red-700',
                default => 'bg-gray-100 text-gray-700'
            };

            $item->formatted_date = Carbon::parse($item->created_at)->format('d F Y');
            $item->initials = substr($item->pelamar->user->name, 0, 2);

            return $item;
        });

        return view('hrd.pelamar', compact('pelamar', 'positions'));
    }

    public function wawancara(Request $request)
    {
        $query = Lamaran::with(['pelamar.user', 'lowongan'])
            ->where('status', 'wawancara');

        // Apply filter if provided
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'week':
                    $query->whereBetween('jadwal_wawancara', [
                        Carbon::today(),
                        Carbon::today()->endOfWeek()
                    ]);
                    break;
                case 'month':
                    $query->whereBetween('jadwal_wawancara', [
                        Carbon::today(),
                        Carbon::today()->endOfMonth()
                    ]);
                    break;
                default:
                    // Default is today's interviews
                    $query->whereDate('jadwal_wawancara', '>=', Carbon::today());
                    break;
            }
        } elseif ($request->has('date')) {
            // Filter by specific date from calendar
            $query->whereDate('jadwal_wawancara', $request->date);
        } else {
            // Default view shows all upcoming interviews
            $query->whereDate('jadwal_wawancara', '>=', Carbon::today());
        }

        // Get all interviews for the calendar (not paginated)
        $allInterviews = Lamaran::with(['pelamar.user', 'lowongan'])
            ->where('status', 'wawancara')
            ->whereBetween('jadwal_wawancara', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->get();

        // Get paginated interviews for the list view
        $wawancara = $query->orderBy('jadwal_wawancara')
            ->paginate(10)
            ->withQueryString();
            
        // Get selected date (if any)
        $selectedDate = $request->date ?? session('selected_date') ?? null;

        return view('hrd.wawancara', compact('wawancara', 'allInterviews', 'selectedDate'));
    }

    public function reviewLamaran($id)
    {
        return $this->updateLamaranStatus(new \Illuminate\Http\Request(['status' => 'review']), $id);
    }

    public function scheduleInterview(Request $request, $id)
    {
        try {
            // Log the request data for debugging
            \Log::info('scheduleInterview request data', [
                'id' => $id,
                'all_data' => $request->all(),
                'is_ajax' => $request->ajax()
            ]);
            
            $lamaran = Lamaran::with(['pelamar.user', 'lowongan'])->findOrFail($id);
            $oldStatus = $lamaran->status; // Store old status for notification
            
            // Validate the request data
            $validated = $request->validate([
                'interview_date' => 'required|date|date_format:Y-m-d',
                'interview_time' => 'required|date_format:H:i',
                'lokasi_wawancara' => 'nullable|string|max:255',
                'interviewer' => 'nullable|string|max:255',
                'catatan' => 'nullable|string'
            ]);
            
            // Log the validated data
            \Log::info('Validated interview data', $validated);

            // Combine date and time and set timezone to match server time
            $timezone = config('app.timezone', 'Asia/Jakarta');
            $jadwalWawancara = Carbon::parse($validated['interview_date'] . ' ' . $validated['interview_time'], $timezone);
            
            // Log the times for debugging
            \Log::info('Interview scheduling times', [
                'now' => now($timezone)->format('Y-m-d H:i:s'),
                'scheduled' => $jadwalWawancara->format('Y-m-d H:i:s'),
                'timezone' => $timezone
            ]);
            
            // Validate that the schedule is not in the past (with 5-minute buffer to account for UI delay)
            $now = now($timezone);
            $bufferMinutes = 5; // 5-minute buffer for UI/network delays
            
            if ($jadwalWawancara->lessThan($now->copy()->subMinutes($bufferMinutes))) {
                $errorMessage = 'Jadwal wawancara tidak boleh di masa lalu. Harap pilih waktu yang akan datang.';
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $errorMessage], 400);
                }
                return back()->with('error', $errorMessage);
            }
            
            // Check if the time is at least 30 minutes from now (reduced from 1 hour)
            $minTime = $now->copy()->addMinutes(30);
            if ($jadwalWawancara->lessThan($minTime)) {
                $errorMessage = 'Jadwal wawancara harus minimal 30 menit dari sekarang.';
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $errorMessage], 400);
                }
                return back()->with('error', $errorMessage);
            }

            // Format tanggal untuk database
            $formattedDate = $jadwalWawancara->format('Y-m-d H:i:s');
            
            // Set status to 'wawancara' and update schedule details
            $lamaran->status = 'wawancara';
            $lamaran->jadwal_wawancara = $formattedDate;

            // Construct and set catatan_hrd
            $catatan_hrd_text = "Lokasi: " . ($validated['lokasi_wawancara'] ?? 'Tidak ditentukan');
            $catatan_hrd_text .= ", Interviewer: " . ($validated['interviewer'] ?? 'Tidak ditentukan');
            if (!empty($validated['catatan'])) {
                $catatan_hrd_text .= ", Catatan Tambahan: " . $validated['catatan'];
            }
            $lamaran->catatan_hrd = $catatan_hrd_text;

            $saved = $lamaran->save();

            // Log hasil update
            \Log::info('Eloquent save result for interview schedule', [
                'id' => $id,
                'saved' => $saved,
                'new_status' => $lamaran->status,
                'jadwal_wawancara' => $lamaran->jadwal_wawancara
            ]);

            if (!$saved) {
                throw new \Exception('Gagal menyimpan jadwal wawancara dan status.');
            }

            // Send general status change notification
            try {
                $lamaran->pelamar->user->notify(new \App\Notifications\ApplicationStatusChanged($lamaran, $oldStatus));
                 \Log::info('ApplicationStatusChanged notification sent for interview schedule', ['lamaran_id' => $lamaran->id]);
            } catch (\Exception $e) {
                \Log::error('Failed to send ApplicationStatusChanged notification for interview schedule', [
                    'lamaran_id' => $lamaran->id,
                    'error' => $e->getMessage()
                ]);
            }
            
            // Buat notifikasi manual menggunakan model Notification kustom
            try {
                $notification = new \App\Models\Notification();
                $notification->pelamar_id = $lamaran->pelamar->id;
                $notification->type = 'wawancara';
                $notification->title = 'Jadwal Wawancara';
                $notification->message = 'Anda telah dijadwalkan untuk wawancara pada ' . date('d F Y', strtotime($lamaran->jadwal_wawancara));
                $notification->is_read = false;
                $notification->related_id = $lamaran->id;
                $notification->related_type = 'App\\Models\\Lamaran';
                $notification->action_text = 'Lihat Detail';
                $notification->action_url = '/lamaran/' . $lamaran->id;
                $notification->save();
                
                \Log::info('Notification created successfully', [
                    'lamaran_id' => $lamaran->id,
                    'pelamar' => $lamaran->pelamar->user->name
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to create notification', [
                    'lamaran_id' => $lamaran->id,
                    'error' => $e->getMessage()
                ]);
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Jadwal wawancara berhasil diatur untuk ' . $lamaran->pelamar->user->name,
                    'data' => [
                        'id' => $lamaran->id,
                        'jadwal_wawancara' => $formattedDate,
                        'pelamar' => $lamaran->pelamar->user->name,
                        'updated' => $updated
                    ]
                ]);
            }
            
            return redirect()
                ->route('hrd.wawancara')
                ->with('success', 'Jadwal wawancara berhasil diatur untuk ' . $lamaran->pelamar->user->name);
        } catch (\Exception $e) {
            \Log::error('Error in scheduleInterview', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengatur jadwal wawancara: ' . $e->getMessage()], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan saat mengatur jadwal wawancara.');
        }
    }
    
    /**
     * Show form to reschedule an interview
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function rescheduleInterviewForm($id)
    {
        try {
            $lamaran = Lamaran::with(['pelamar.user', 'lowongan'])->findOrFail($id);
            
            // Validate that the application is in interview status
            if ($lamaran->status !== 'wawancara') {
                return redirect()->route('hrd.wawancara')
                    ->with('error', 'Hanya lamaran dengan status wawancara yang dapat dijadwalkan ulang.');
            }
            
            return view('hrd.wawancara.reschedule', compact('lamaran'));
        } catch (\Exception $e) {
            \Log::error('Error in rescheduleInterviewForm', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('hrd.wawancara')
                ->with('error', 'Terjadi kesalahan saat memuat form penjadwalan ulang.');
        }
    }
    
    /**
     * Reschedule an interview
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rescheduleInterview(Request $request, $id)
    {
        try {
            $lamaran = Lamaran::with(['pelamar.user', 'lowongan'])->findOrFail($id);
            
            // Validate that the application is in interview status
            if ($lamaran->status !== 'wawancara') {
                return back()->with('error', 'Hanya lamaran dengan status wawancara yang dapat dijadwalkan ulang.');
            }
            
            // Validate request
            $validated = $request->validate([
                'interview_date' => 'required|date|after_or_equal:today',
                'interview_time' => 'required|date_format:H:i',
                'lokasi_wawancara' => 'nullable|string|max:255',
                'interviewer' => 'nullable|string|max:255',
                'catatan' => 'nullable|string'
            ]);
            
            // Combine date and time
            $jadwalWawancara = Carbon::parse($validated['interview_date'] . ' ' . $validated['interview_time']);
            
            // Update interview details
            $lamaran->jadwal_wawancara = $jadwalWawancara;
            
            if (isset($validated['lokasi_wawancara'])) {
                $lamaran->lokasi_wawancara = $validated['lokasi_wawancara'];
            }
            
            if (isset($validated['interviewer'])) {
                $lamaran->interviewer = $validated['interviewer'];
            }
            
            if (isset($validated['catatan'])) {
                $lamaran->catatan_wawancara = $validated['catatan'];
            }
            
            $lamaran->save();
            
            // Send notification to applicant
            $lamaran->pelamar->user->notify(new \App\Notifications\InterviewRescheduled($lamaran));
            
            return redirect()->route('hrd.wawancara')
                ->with('success', 'Jadwal wawancara berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Error in rescheduleInterview', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal wawancara.');
        }
    }

    public function showPelamar($id)
    {
        try {
            // Load pelamar with all necessary relationships and data
            $pelamar = Pelamar::with([
                'user',
                'lamaran' => function($query) {
                    $query->with('lowongan')
                          ->orderBy('created_at', 'desc');
                }
            ])->findOrFail($id);

            // Format the data
            $pelamar->skills = json_decode($pelamar->skills) ?? [];
            
            // Format pengalaman
            $pengalaman = json_decode($pelamar->pengalaman) ?? [];
            if (is_array($pengalaman)) {
                foreach ($pengalaman as &$exp) {
                    $exp = (object) $exp;
                }
            }
            $pelamar->pengalaman = $pengalaman;

            // Format pendidikan
            $pendidikan = json_decode($pelamar->pendidikan) ?? [];
            if (is_array($pendidikan)) {
                foreach ($pendidikan as &$edu) {
                    $edu = (object) $edu;
                }
            }
            $pelamar->pendidikan = $pendidikan;

            // Format lamaran data
            foreach ($pelamar->lamaran as $lamaran) {
                $lamaran->status_class = match($lamaran->status) {
                    'pending' => 'bg-gray-100 text-gray-700',
                    'review' => 'bg-purple-100 text-purple-700',
                    'wawancara' => 'bg-pink-100 text-pink-700',
                    'diterima' => 'bg-green-100 text-green-700',
                    'ditolak' => 'bg-red-100 text-red-700',
                    default => 'bg-gray-100 text-gray-700'
                };

                if ($lamaran->jadwal_wawancara) {
                    $lamaran->formatted_jadwal = Carbon::parse($lamaran->jadwal_wawancara)
                        ->translatedFormat('l, d F Y - H:i');
                }

                $lamaran->formatted_date = Carbon::parse($lamaran->created_at)
                    ->translatedFormat('d F Y');
            }

            // Get interview schedule if exists
            $nextInterview = $pelamar->lamaran()
                ->where('status', 'wawancara')
                ->whereNotNull('jadwal_wawancara')
                ->where('jadwal_wawancara', '>=', now())
                ->orderBy('jadwal_wawancara', 'asc')
                ->first();

            return view('hrd.pelamar.show', compact('pelamar', 'nextInterview'));

        } catch (\Exception $e) {
            \Log::error('Error in showPelamar', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->route('hrd.pelamar')
                ->with('error', 'Terjadi kesalahan saat menampilkan detail pelamar. Silakan coba lagi nanti.');
        }
    }

    public function updateLamaranStatus(Request $request, $id)
    {
        try {
            $lamaran = Lamaran::with(['pelamar.user', 'lowongan'])->findOrFail($id);
            $oldStatus = $lamaran->status;
            $newStatus = trim(strtolower($request->status));
            
            // Log the status change attempt for debugging
            \Log::info('Attempting to update status', [
                'id' => $id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus
            ]);
            
            // Validate the status value
            if (!in_array($newStatus, Lamaran::$validStatuses)) {
                throw new \Exception("Invalid status value: {$newStatus}");
            }
            
            // If status changed to wawancara, redirect to interview scheduling page without saving status yet
            if ($newStatus === 'wawancara') {
                $today = now()->format('Y-m-d');
                return redirect()
                    ->route('hrd.wawancara')
                    ->with([
                        // Success message changed to reflect that user needs to schedule
                        'success' => 'Pelamar akan dijadwalkan untuk wawancara. Silakan pilih tanggal.',
                        'schedule_interview_id' => $lamaran->id,
                        'selected_date' => $today
                    ]);
            }

            // For other statuses, update and save
            $lamaran->status = $newStatus;
            
            // Save the model and check if it was successful
            $saved = $lamaran->save();
            
            // Verify the status was actually updated
            $updatedLamaran = Lamaran::find($id);
            
            \Log::info('Status update result', [
                'save_result' => $saved,
                'updated_status' => $updatedLamaran->status,
                'status_changed' => $updatedLamaran->status === $newStatus
            ]);
            
            if ($updatedLamaran->status === $newStatus) {
                // Send notification to applicant (except for 'wawancara' which is handled in scheduleInterview)
                $lamaran->pelamar->user->notify(new \App\Notifications\ApplicationStatusChanged($lamaran, $oldStatus));
                
                return back()->with('success', 'Status lamaran berhasil diperbarui.');
            }
            
            throw new \Exception("Status was not updated in the database for status: {$newStatus}");
        } catch (\Exception $e) {
            // Check if the status was actually updated despite the exception
            $updatedLamaran = Lamaran::find($id);
            $newStatus = trim(strtolower($request->status));
            
            if ($updatedLamaran && $updatedLamaran->status === $newStatus && $newStatus !== 'wawancara') {
                // Status was updated for non-wawancara statuses despite the exception, so return success
                return back()->with('success', 'Status lamaran berhasil diperbarui (meskipun ada peringatan).');
            }
            // If it was 'wawancara' and somehow status got updated and an exception occurred, it's an anomaly.
            // Or if a non-wawancara status failed to update.
            
            \Log::error('Error in updateLamaranStatus', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status lamaran.');
        }
    }


    
    public function downloadCV($id)
    {
        try {
            $pelamar = Pelamar::findOrFail($id);
            
            if (!$pelamar->cv_path) {
                return back()->with('error', 'CV tidak tersedia.');
            }

            // Log attempt
            \Log::info('Attempting to download CV', [
                'pelamar_id' => $id,
                'cv_path' => $pelamar->cv_path,
                'full_path' => FileHelper::getFullPath($pelamar->cv_path)
            ]);

            // Check if file exists
            if (!FileHelper::cvExists($pelamar->cv_path)) {
                \Log::error('CV file not found', [
                    'pelamar_id' => $id,
                    'cv_path' => $pelamar->cv_path,
                    'full_path' => FileHelper::getFullPath($pelamar->cv_path)
                ]);
                return back()->with('error', 'File CV tidak ditemukan di server. Mohon hubungi admin.');
            }

            // Get the correct storage path
            $cvPath = 'public/' . $pelamar->cv_path;
            
            // Get file mime type and extension
            $mimeType = Storage::mimeType($cvPath);
            $extension = strtolower(pathinfo($pelamar->cv_path, PATHINFO_EXTENSION));
            
            // Log file information
            \Log::info('File information', [
                'mime_type' => $mimeType,
                'extension' => $extension,
                'path' => $cvPath
            ]);
            
            // Allow common document formats
            $allowedExtensions = ['pdf', 'doc', 'docx'];
            $allowedMimes = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-word',
                'application/x-pdf',
                'binary/octet-stream' // For some PDF files
            ];
            
            if (!in_array($extension, $allowedExtensions)) {
                return back()->with('error', 'Format file CV tidak valid. Format yang diizinkan: PDF, DOC, DOCX');
            }

            // Generate a proper filename
            $filename = Str::slug($pelamar->user->name) . '_CV.' . $extension;

            // Return the file download response with appropriate headers
            return Storage::download($cvPath, $filename, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Data pelamar tidak ditemukan.');
        } catch (\Exception $e) {
            \Log::error('Error downloading CV', [
                'pelamar_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mengunduh CV. Silakan coba lagi nanti.');
        }
    }
} 