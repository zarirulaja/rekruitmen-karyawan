<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the pelamar dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;
        
        if (!$pelamar) {
            return redirect()->route('profil')->with('error', 'Harap lengkapi profil Anda terlebih dahulu.');
        }
        
        // Get active applications count
        $activeApplicationsCount = Lamaran::where('pelamar_id', $pelamar->id)
            ->whereIn('status', ['pending', 'review', 'wawancara'])
            ->count();
        
        // Get interview count
        $interviewCount = Lamaran::where('pelamar_id', $pelamar->id)
            ->where('status', 'wawancara')
            ->count();
        
        // For now, assume we don't have a saved jobs table
        // This would need to be implemented separately
        $savedJobsCount = 0;
        
        // Get recent applications
        $recentApplications = Lamaran::where('pelamar_id', $pelamar->id)
            ->with('lowongan')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Get upcoming interviews
        $upcomingInterviews = Lamaran::where('pelamar_id', $pelamar->id)
            ->where('status', 'wawancara')
            ->with('lowongan')
            ->orderBy('created_at', 'desc')
            ->first();
        
        return view('dashboard-pelamar', compact(
            'activeApplicationsCount',
            'interviewCount',
            'savedJobsCount',
            'recentApplications',
            'upcomingInterviews'
        ));
    }
} 