<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;
        
        if (!$pelamar) {
            return redirect()->route('profil')->with('error', 'Harap lengkapi profil Anda terlebih dahulu.');
        }
        
        // Filter notifications by type if specified
        $type = $request->query('type');
        $query = Notification::where('pelamar_id', $pelamar->id);
        
        if ($type && in_array($type, ['lamaran', 'wawancara', 'lowongan'])) {
            $query->where('type', $type);
        }
        
        // Get notifications paginated
        $notifications = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Process timestamps to display relative time
        foreach ($notifications as $notification) {
            $notification->time_ago = $this->getTimeAgo($notification->created_at);
        }
        
        // Count unread notifications of each type
        $unreadCounts = [
            'all' => Notification::where('pelamar_id', $pelamar->id)
                ->where('is_read', false)->count(),
            'lamaran' => Notification::where('pelamar_id', $pelamar->id)
                ->where('type', 'lamaran')->where('is_read', false)->count(),
            'wawancara' => Notification::where('pelamar_id', $pelamar->id)
                ->where('type', 'wawancara')->where('is_read', false)->count(),
            'lowongan' => Notification::where('pelamar_id', $pelamar->id)
                ->where('type', 'lowongan')->where('is_read', false)->count(),
        ];
        
        return view('notifikasi-pelamar', compact('notifications', 'unreadCounts', 'type'));
    }
    
    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;
        
        $notification = Notification::where('id', $id)
            ->where('pelamar_id', $pelamar->id)
            ->first();
            
        if ($notification) {
            $notification->markAsRead();
        }
        
        return redirect()->back();
    }
    
    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;
        
        $type = $request->query('type');
        $query = Notification::where('pelamar_id', $pelamar->id)
            ->where('is_read', false);
            
        if ($type && in_array($type, ['lamaran', 'wawancara', 'lowongan'])) {
            $query->where('type', $type);
        }
        
        $query->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
    
    /**
     * Helper function to format time in a human-readable way.
     */
    private function getTimeAgo($timestamp)
    {
        $carbon = Carbon::parse($timestamp);
        $now = Carbon::now();
        
        if ($carbon->isToday()) {
            if ($carbon->diffInHours($now) < 1) {
                $minutes = $carbon->diffInMinutes($now);
                return $minutes . ' menit yang lalu';
            }
            $hours = $carbon->diffInHours($now);
            return $hours . ' jam yang lalu';
        }
        
        if ($carbon->isYesterday()) {
            return 'kemarin';
        }
        
        if ($carbon->diffInDays($now) < 7) {
            return $carbon->diffInDays($now) . ' hari yang lalu';
        }
        
        if ($carbon->diffInWeeks($now) < 4) {
            return $carbon->diffInWeeks($now) . ' minggu yang lalu';
        }
        
        return $carbon->format('d F Y');
    }
}
