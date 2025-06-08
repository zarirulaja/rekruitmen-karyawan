<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class LowonganController extends Controller
{
    /**
     * Display a listing of the job vacancies.
     */
    public function index(Request $request)
    {
        $query = Lowongan::where('status', 1)
                         ->where('tanggal_tutup', '>=', now()->toDateString());
        
        // Apply search filter if search parameter is provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('posisi', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhere('persyaratan', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%');
            });
        }
        
        $lowongan = $query->orderBy('created_at', 'desc')->get();
        
        return view('lowongan-kerja', compact('lowongan'));
    }

    /**
     * Display the specified job vacancy.
     */
    public function show($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('detail-lowongan', compact('lowongan'));
    }
    
    /**
     * Send notifications to relevant applicants about a new job posting.
     * This would be called when a new job posting is created by the HR.
     */
    public function sendNewJobNotifications(Lowongan $lowongan)
    {
        try {
            // Get all active pelamar (may be filtered by skills or other criteria in a real implementation)
            $pelamars = Pelamar::all();
            
            foreach ($pelamars as $pelamar) {
                NotificationService::newLowongan($pelamar, $lowongan);
            }
            
            Log::info('Sent new job notifications', [
                'lowongan_id' => $lowongan->id,
                'pelamar_count' => $pelamars->count()
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send new job notifications', [
                'error' => $e->getMessage(),
                'lowongan_id' => $lowongan->id
            ]);
            
            return false;
        }
    }
} 