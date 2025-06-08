<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;

class LamaranController extends Controller
{
    /**
     * Store a new job application.
     */
    public function store(Request $request, $lowongan_id)
    {
        try {
            Log::info('Starting job application process', ['lowongan_id' => $lowongan_id]);
            
            $lowongan = Lowongan::findOrFail($lowongan_id);
            $pelamar = Auth::user()->pelamar;
            
            if (!$pelamar) {
                Log::warning('Pelamar not found for user', ['user_id' => Auth::id()]);
                return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
            }
            
            // Validate that the position is still open
            if ($lowongan->status != 1 || $lowongan->tanggal_tutup < now()->toDateString()) {
                Log::warning('Job is no longer accepting applications', [
                    'status' => $lowongan->status, 
                    'end_date' => $lowongan->tanggal_tutup,
                    'today' => now()->toDateString()
                ]);
                return redirect()->back()->with('error', 'Lowongan ini sudah tidak menerima lamaran baru.');
            }
            
            // Check if already applied
            $alreadyApplied = Lamaran::where('pelamar_id', $pelamar->id)
                                    ->where('lowongan_id', $lowongan->id)
                                    ->exists();
            
            if ($alreadyApplied) {
                Log::info('User already applied for this position', [
                    'pelamar_id' => $pelamar->id, 
                    'lowongan_id' => $lowongan->id
                ]);
                return redirect()->back()->with('error', 'Anda sudah pernah melamar untuk posisi ini.');
            }
            
            // Validate request
            $validated = $request->validate([
                'pesan_tambahan' => 'nullable|string',
                'file-upload' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);
            
            Log::info('Request validated', ['has_file' => $request->hasFile('file-upload')]);
            
            // Handle CV
            $cv_path = $pelamar->cv_path;
            
            // If user has uploaded a new CV file
            if ($request->hasFile('file-upload')) {
                // Delete existing CV if there is one
                if (!empty($pelamar->cv_path) && Storage::exists('public/' . $pelamar->cv_path)) {
                    Storage::delete('public/' . $pelamar->cv_path);
                    Log::info('Deleted existing CV file', ['previous_path' => $pelamar->cv_path]);
                }
                
                // Generate a unique filename
                $filename = uniqid('cv_') . '_' . Auth::id() . '.' . $request->file('file-upload')->extension();
                
                // Upload the new CV file
                $path = $request->file('file-upload')->storeAs('cv', $filename, 'public');
                Log::info('Uploaded CV file', ['new_path' => $path]);
                
                // Update user's profile CV
                $pelamar->cv_path = $path;
                $pelamar->save();
                
                $cv_path = $path;
            }
            
            // Ensure there is a CV available
            if (empty($cv_path)) {
                Log::warning('No CV available', ['pelamar_id' => $pelamar->id]);
                return redirect()->back()->with('error', 'Anda harus mengunggah CV untuk melamar.');
            }
            
            // Create application data
            $lamaranData = [
                'pelamar_id' => $pelamar->id,
                'lowongan_id' => $lowongan->id,
                'status' => 'pending',
                'tanggal_lamar' => now(),
                'pesan_tambahan' => $request->pesan_tambahan,
            ];
            
            Log::info('Creating lamaran record', $lamaranData);
            
            // Create new application
            $lamaran = Lamaran::create($lamaranData);
            
            Log::info('Successfully created job application', ['lamaran_id' => $lamaran->id]);
            
            // Create notification for the user
            try {
                NotificationService::lamaranStatusUpdated($lamaran);
                Log::info('Created application notification for user', ['lamaran_id' => $lamaran->id]);
            } catch (\Exception $e) {
                Log::error('Failed to create notification', [
                    'error' => $e->getMessage(),
                    'lamaran_id' => $lamaran->id
                ]);
            }
            
            return redirect()->route('lamaran-saya')->with('success', 'Lamaran berhasil dikirim! Kami akan meninjau lamaran Anda segera.');
        } catch (\Exception $e) {
            Log::error('Error in lamaran submission', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'lowongan_id' => $lowongan_id ?? null,
                'user_id' => Auth::id()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim lamaran: ' . $e->getMessage());
        }
    }
    
    /**
     * Display a listing of the user's applications.
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user->pelamar) {
            return redirect()->route('profil')->with('error', 'Harap lengkapi profil Anda terlebih dahulu.');
        }
        
        $lamaran = Lamaran::where('pelamar_id', $user->pelamar->id)
                           ->with('lowongan')
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        return view('lamaran-saya', compact('lamaran'));
    }
} 