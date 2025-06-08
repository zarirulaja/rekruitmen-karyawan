<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Lamaran;

class ApplicationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $lamaran;
    protected $oldStatus;

    public function __construct(Lamaran $lamaran, $oldStatus)
    {
        $this->lamaran = $lamaran;
        $this->oldStatus = $oldStatus;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        $statusMessages = [
            'pending' => 'sedang menunggu review',
            'review' => 'sedang dalam proses review',
            'wawancara' => 'telah dijadwalkan untuk wawancara',
            'diterima' => 'telah diterima',
            'ditolak' => 'tidak dapat kami terima'
        ];

        $message = $statusMessages[$this->lamaran->status] ?? 'telah diupdate';

        return (new MailMessage)
            ->subject('Status Lamaran Anda Telah Diperbarui')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Status lamaran Anda untuk posisi ' . $this->lamaran->lowongan->posisi . ' ' . $message . '.')
            ->line('Silakan cek detail lamaran Anda di dashboard untuk informasi lebih lanjut.')
            ->action('Lihat Detail Lamaran', route('lamaran-saya'));
    }

    public function toArray($notifiable)
    {
        return [
            'lamaran_id' => $this->lamaran->id,
            'lowongan_id' => $this->lamaran->lowongan_id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->lamaran->status,
            'position' => $this->lamaran->lowongan->posisi
        ];
    }
} 