<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Pelamar;
use App\Models\Lamaran;
use App\Models\Lowongan;

class NotificationService
{
    /**
     * Create a new notification for a pelamar.
     *
     * @param Pelamar $pelamar The pelamar to notify
     * @param string $title The notification title
     * @param string $message The notification message
     * @param string $type The notification type (lamaran, wawancara, lowongan)
     * @param array $data Additional data for the notification
     * @param mixed $related Related model instance
     * @param string|null $actionText Text for the action button
     * @param string|null $actionUrl URL for the action button
     * @return Notification
     */
    public static function create(
        Pelamar $pelamar,
        string $title,
        string $message,
        string $type,
        array $data = [],
        $related = null,
        ?string $actionText = null,
        ?string $actionUrl = null
    ): Notification {
        $notification = new Notification();
        $notification->pelamar_id = $pelamar->id;
        $notification->title = $title;
        $notification->message = $message;
        $notification->type = $type;
        $notification->data = $data;
        $notification->is_read = false;
        
        if ($related) {
            $notification->related_id = $related->id;
            $notification->related_type = get_class($related);
        }
        
        $notification->action_text = $actionText;
        $notification->action_url = $actionUrl;
        
        $notification->save();
        
        return $notification;
    }
    
    /**
     * Create a lamaran status update notification.
     *
     * @param Lamaran $lamaran The lamaran that was updated
     * @param string $status The new status
     * @return Notification
     */
    public static function lamaranStatusUpdated(Lamaran $lamaran): Notification
    {
        $pelamar = $lamaran->pelamar;
        $lowongan = $lamaran->lowongan;
        
        $title = 'Status Lamaran Diperbarui';
        $message = "Lamaran Anda untuk posisi <span class=\"font-medium\">{$lowongan->posisi}</span> telah diperbarui.";
        
        $data = [
            'details' => [
                "Status: {$lamaran->status}",
                "Lamaran dibuat pada: " . $lamaran->created_at->format('d F Y'),
            ]
        ];
        
        return self::create(
            $pelamar,
            $title,
            $message,
            'lamaran',
            $data,
            $lamaran,
            null,
            null
        );
    }
    
    /**
     * Create a new interview notification.
     *
     * @param Lamaran $lamaran The lamaran that has an interview scheduled
     * @param string $date Interview date
     * @param string $time Interview time
     * @param string $location Interview location or medium (e.g. Zoom, Google Meet)
     * @return Notification
     */
    public static function wawancaraScheduled(Lamaran $lamaran, string $date, string $time, string $location): Notification
    {
        $pelamar = $lamaran->pelamar;
        $lowongan = $lamaran->lowongan;
        
        $title = 'Undangan Wawancara';
        $message = "Anda diundang untuk wawancara posisi <span class=\"font-medium\">{$lowongan->posisi}</span> pada:";
        
        $data = [
            'details' => [
                "{$date}, {$time}",
                "Via {$location}",
            ]
        ];
        
        return self::create(
            $pelamar,
            $title,
            $message,
            'wawancara',
            $data,
            $lamaran,
            null,
            null
        );
    }
    
    /**
     * Create a new job posting notification.
     *
     * @param Pelamar $pelamar The pelamar to notify
     * @param Lowongan $lowongan The new job posting
     * @return Notification
     */
    public static function newLowongan(Pelamar $pelamar, Lowongan $lowongan): Notification
    {
        $title = 'Lowongan Baru';
        $message = "Lowongan baru yang sesuai dengan profil Anda: <span class=\"font-medium\">{$lowongan->posisi}</span>";
        
        $data = [
            'details' => [
                "Perusahaan: {$lowongan->perusahaan}",
                "Lokasi: {$lowongan->lokasi}",
            ]
        ];
        
        return self::create(
            $pelamar,
            $title,
            $message,
            'lowongan',
            $data,
            $lowongan,
            null,
            null
        );
    }
} 