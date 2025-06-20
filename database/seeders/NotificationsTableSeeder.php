<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pelamar_id' => 1,
                'title' => 'Lowongan Baru',
                'message' => 'Lowongan baru yang sesuai dengan profil Anda: <span class="font-medium">UI/UX Designer</span>',
                'type' => 'lowongan',
                'data' => '{"details":["Perusahaan: ","Lokasi: Hybrid"]}',
                'is_read' => 1,
                'related_id' => 2,
                'related_type' => 'App\\Models\\Lowongan',
                'action_text' => 'Lihat Lowongan',
                'action_url' => 'http://localhost/lowongan/2',
                'created_at' => '2025-05-10 14:15:25',
                'updated_at' => '2025-05-21 14:15:25',
            ),
            1 => 
            array (
                'id' => 2,
                'pelamar_id' => 2,
                'title' => 'Lowongan Baru',
                'message' => 'Lowongan baru yang sesuai dengan profil Anda: <span class="font-medium">Frontend Developer</span>',
                'type' => 'lowongan',
                'data' => '{"details":["Perusahaan: ","Lokasi: Onsite"]}',
                'is_read' => 0,
                'related_id' => 3,
                'related_type' => 'App\\Models\\Lowongan',
                'action_text' => 'Lihat Lowongan',
                'action_url' => 'http://localhost/lowongan/3',
                'created_at' => '2025-05-12 14:15:25',
                'updated_at' => '2025-05-21 14:15:25',
            ),
            2 => 
            array (
                'id' => 3,
                'pelamar_id' => 3,
                'title' => 'Lowongan Baru',
                'message' => 'Lowongan baru yang sesuai dengan profil Anda: <span class="font-medium">UI/UX Designer</span>',
                'type' => 'lowongan',
                'data' => '{"details":["Perusahaan: ","Lokasi: Hybrid"]}',
                'is_read' => 0,
                'related_id' => 2,
                'related_type' => 'App\\Models\\Lowongan',
                'action_text' => 'Lihat Lowongan',
                'action_url' => 'http://localhost/lowongan/2',
                'created_at' => '2025-05-10 14:15:25',
                'updated_at' => '2025-05-21 14:15:25',
            ),
            3 => 
            array (
                'id' => 4,
                'pelamar_id' => 4,
                'title' => 'Status Lamaran Diperbarui',
                'message' => 'Lamaran Anda untuk posisi <span class="font-medium">Backend Developer</span> telah diperbarui.',
                'type' => 'lamaran',
                'data' => '{"details":["Status: pending","Lamaran dibuat pada: 21 May 2025"]}',
                'is_read' => 1,
                'related_id' => 1,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => 'http://localhost/lamaran-saya',
                'created_at' => '2025-05-15 14:15:25',
                'updated_at' => '2025-05-21 14:16:20',
            ),
            4 => 
            array (
                'id' => 5,
                'pelamar_id' => 4,
                'title' => 'Undangan Wawancara',
                'message' => 'Anda diundang untuk wawancara posisi <span class="font-medium">Backend Developer</span> pada:',
                'type' => 'wawancara',
                'data' => '{"details":["30 May 2025, 10:00 WIB","Via Google Meet"]}',
                'is_read' => 1,
                'related_id' => 1,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => 'http://localhost/lamaran-saya',
                'created_at' => '2025-05-21 14:15:25',
                'updated_at' => '2025-05-21 14:15:25',
            ),
            5 => 
            array (
                'id' => 6,
                'pelamar_id' => 4,
                'title' => 'Lowongan Baru',
                'message' => 'Lowongan baru yang sesuai dengan profil Anda: <span class="font-medium">Frontend Developer</span>',
                'type' => 'lowongan',
                'data' => '{"details":["Perusahaan: ","Lokasi: Onsite"]}',
                'is_read' => 1,
                'related_id' => 3,
                'related_type' => 'App\\Models\\Lowongan',
                'action_text' => 'Lihat Lowongan',
                'action_url' => 'http://localhost/lowongan/3',
                'created_at' => '2025-05-09 14:15:25',
                'updated_at' => '2025-05-21 14:15:25',
            ),
            6 => 
            array (
                'id' => 7,
                'pelamar_id' => 4,
                'title' => 'Status Lamaran Diperbarui',
                'message' => 'Lamaran Anda untuk posisi <span class="font-medium">tukang turu</span> telah diperbarui.',
                'type' => 'lamaran',
                'data' => '{"details":["Status: pending","Lamaran dibuat pada: 03 June 2025"]}',
                'is_read' => 1,
                'related_id' => 7,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => NULL,
                'action_url' => NULL,
                'created_at' => '2025-06-03 15:13:07',
                'updated_at' => '2025-06-07 12:42:51',
            ),
            7 => 
            array (
                'id' => 8,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 06 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 7,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/7',
                'created_at' => '2025-06-03 15:14:36',
                'updated_at' => '2025-06-07 12:42:51',
            ),
            8 => 
            array (
                'id' => 9,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-07 12:35:35',
                'updated_at' => '2025-06-07 12:42:51',
            ),
            9 => 
            array (
                'id' => 10,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:38:54',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            10 => 
            array (
                'id' => 11,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 11 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:39:29',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            11 => 
            array (
                'id' => 12,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 09 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:39:57',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            12 => 
            array (
                'id' => 13,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:40:27',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            13 => 
            array (
                'id' => 14,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 09 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:40:52',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            14 => 
            array (
                'id' => 15,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 09 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:45:08',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            15 => 
            array (
                'id' => 16,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:45:26',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            16 => 
            array (
                'id' => 17,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 09 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 05:50:41',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            17 => 
            array (
                'id' => 18,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 06:00:08',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            18 => 
            array (
                'id' => 19,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 06:00:41',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            19 => 
            array (
                'id' => 20,
                'pelamar_id' => 4,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 10 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 6,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/6',
                'created_at' => '2025-06-09 06:01:02',
                'updated_at' => '2025-06-09 06:01:27',
            ),
            20 => 
            array (
                'id' => 21,
                'pelamar_id' => 5,
                'title' => 'Status Lamaran Diperbarui',
                'message' => 'Lamaran Anda untuk posisi <span class="font-medium">UI/UX Designer</span> telah diperbarui.',
                'type' => 'lamaran',
                'data' => '{"details":["Status: pending","Lamaran dibuat pada: 10 June 2025"]}',
                'is_read' => 1,
                'related_id' => 8,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => NULL,
                'action_url' => NULL,
                'created_at' => '2025-06-10 06:02:05',
                'updated_at' => '2025-06-10 06:02:09',
            ),
            21 => 
            array (
                'id' => 22,
                'pelamar_id' => 5,
                'title' => 'Jadwal Wawancara',
                'message' => 'Anda telah dijadwalkan untuk wawancara pada 12 June 2025',
                'type' => 'wawancara',
                'data' => NULL,
                'is_read' => 1,
                'related_id' => 8,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => 'Lihat Detail',
                'action_url' => '/lamaran/8',
                'created_at' => '2025-06-10 06:04:21',
                'updated_at' => '2025-06-10 06:04:48',
            ),
            22 => 
            array (
                'id' => 23,
                'pelamar_id' => 4,
                'title' => 'Status Lamaran Diperbarui',
                'message' => 'Lamaran Anda untuk posisi <span class="font-medium">chef</span> telah diperbarui.',
                'type' => 'lamaran',
                'data' => '{"details":["Status: pending","Lamaran dibuat pada: 10 June 2025"]}',
                'is_read' => 0,
                'related_id' => 9,
                'related_type' => 'App\\Models\\Lamaran',
                'action_text' => NULL,
                'action_url' => NULL,
                'created_at' => '2025-06-10 10:58:26',
                'updated_at' => '2025-06-10 10:58:26',
            ),
        ));
        
        
    }
}