<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelamar;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Services\NotificationService;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all pelamar
        $pelamars = Pelamar::all();
        
        if ($pelamars->count() === 0) {
            $this->command->info('No pelamar found. Please run the UserSeeder first.');
            return;
        }
        
        // Get all lowongan
        $lowongans = Lowongan::all();
        
        if ($lowongans->count() === 0) {
            $this->command->info('No lowongan found. Please run the LowonganSeeder first.');
            return;
        }
        
        // Get all lamaran
        $lamarans = Lamaran::all();
        
        // Create sample notifications
        foreach ($pelamars as $pelamar) {
            // Sample for job application status update
            if ($lamarans->where('pelamar_id', $pelamar->id)->count() > 0) {
                $lamaran = $lamarans->where('pelamar_id', $pelamar->id)->first();
                
                // Create a lamaran status notification
                $notification = new \App\Models\Notification();
                $notification->pelamar_id = $pelamar->id;
                $notification->title = 'Status Lamaran Diperbarui';
                $notification->message = "Lamaran Anda untuk posisi <span class=\"font-medium\">{$lamaran->lowongan->posisi}</span> telah diperbarui.";
                $notification->type = 'lamaran';
                $notification->data = [
                    'details' => [
                        "Status: {$lamaran->status}",
                        "Lamaran dibuat pada: " . $lamaran->created_at->format('d F Y'),
                    ]
                ];
                $notification->is_read = false;
                $notification->related_id = $lamaran->id;
                $notification->related_type = get_class($lamaran);
                $notification->action_text = null;
                $notification->action_url = null;
                $notification->created_at = Carbon::now()->subDays(rand(0, 7));
                $notification->save();
            }
            
            // Sample for interview invitation
            if ($lamarans->where('pelamar_id', $pelamar->id)->count() > 0) {
                $lamaran = $lamarans->where('pelamar_id', $pelamar->id)->first();
                
                // Create an interview notification
                $notification = new \App\Models\Notification();
                $notification->pelamar_id = $pelamar->id;
                $notification->title = 'Undangan Wawancara';
                $notification->message = "Anda diundang untuk wawancara posisi <span class=\"font-medium\">{$lamaran->lowongan->posisi}</span> pada:";
                $notification->type = 'wawancara';
                $notification->data = [
                    'details' => [
                        Carbon::now()->addDays(rand(3, 10))->format('d F Y') . ", 10:00 WIB",
                        "Via Google Meet",
                    ]
                ];
                $notification->is_read = rand(0, 1) === 1;
                $notification->related_id = $lamaran->id;
                $notification->related_type = get_class($lamaran);
                $notification->action_text = null;
                $notification->action_url = null;
                $notification->created_at = Carbon::now()->subDays(rand(0, 3));
                $notification->save();
            }
            
            // Sample for new job posting
            $randomLowongan = $lowongans->random();
            
            // Create a new job notification
            $notification = new \App\Models\Notification();
            $notification->pelamar_id = $pelamar->id;
            $notification->title = 'Lowongan Baru';
            $notification->message = "Lowongan baru yang sesuai dengan profil Anda: <span class=\"font-medium\">{$randomLowongan->posisi}</span>";
            $notification->type = 'lowongan';
            $notification->data = [
                'details' => [
                    "Perusahaan: {$randomLowongan->perusahaan}",
                    "Lokasi: {$randomLowongan->lokasi}",
                ]
            ];
            $notification->is_read = rand(0, 1) === 1;
            $notification->related_id = $randomLowongan->id;
            $notification->related_type = get_class($randomLowongan);
            $notification->action_text = null;
            $notification->action_url = null;
            $notification->created_at = Carbon::now()->subDays(rand(1, 14));
            $notification->save();
        }
        
        $this->command->info('Sample notifications created successfully!');
    }
}
