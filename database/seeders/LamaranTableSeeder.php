<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LamaranTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lamaran')->delete();
        
        \DB::table('lamaran')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pelamar_id' => 4,
                'lowongan_id' => 1,
                'status' => 'pending',
                'jadwal_wawancara' => NULL,
                'catatan_hrd' => NULL,
                'tanggal_lamar' => '2025-05-21',
                'pesan_tambahan' => 'cek',
                'created_at' => '2025-05-21 13:59:17',
                'updated_at' => '2025-06-09 06:03:00',
                'lokasi_wawancara' => NULL,
                'interviewer' => NULL,
                'catatan_wawancara' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'pelamar_id' => 1,
                'lowongan_id' => 2,
                'status' => 'pending',
                'jadwal_wawancara' => NULL,
                'catatan_hrd' => NULL,
                'tanggal_lamar' => '2025-05-22',
                'pesan_tambahan' => NULL,
                'created_at' => '2025-05-22 05:44:47',
                'updated_at' => '2025-06-09 06:02:57',
                'lokasi_wawancara' => NULL,
                'interviewer' => NULL,
                'catatan_wawancara' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'pelamar_id' => 4,
                'lowongan_id' => 2,
                'status' => 'pending',
                'jadwal_wawancara' => NULL,
                'catatan_hrd' => NULL,
                'tanggal_lamar' => '2025-05-22',
                'pesan_tambahan' => NULL,
                'created_at' => '2025-05-22 12:50:23',
                'updated_at' => '2025-06-09 06:02:55',
                'lokasi_wawancara' => NULL,
                'interviewer' => NULL,
                'catatan_wawancara' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'pelamar_id' => 1,
                'lowongan_id' => 3,
                'status' => 'pending',
                'jadwal_wawancara' => NULL,
                'catatan_hrd' => NULL,
                'tanggal_lamar' => '2025-05-24',
                'pesan_tambahan' => NULL,
                'created_at' => '2025-05-24 06:48:47',
                'updated_at' => '2025-06-09 06:02:53',
                'lokasi_wawancara' => NULL,
                'interviewer' => NULL,
                'catatan_wawancara' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'pelamar_id' => 4,
                'lowongan_id' => 3,
                'status' => 'pending',
                'jadwal_wawancara' => '2025-06-10 14:00:00',
                'catatan_hrd' => 'Lokasi: kasur, Interviewer: golgra',
                'tanggal_lamar' => '2025-06-01',
                'pesan_tambahan' => NULL,
                'created_at' => '2025-06-01 19:41:22',
                'updated_at' => '2025-06-09 06:02:52',
                'lokasi_wawancara' => NULL,
                'interviewer' => 'robi',
                'catatan_wawancara' => NULL,
            ),
            5 => 
            array (
                'id' => 8,
                'pelamar_id' => 5,
                'lowongan_id' => 2,
                'status' => 'wawancara',
                'jadwal_wawancara' => '2025-06-12 14:05:00',
                'catatan_hrd' => 'Lokasi: zoom, Interviewer: ijul, Catatan Tambahan: harap datang tepat waktu',
                'tanggal_lamar' => '2025-06-10',
                'pesan_tambahan' => NULL,
                'created_at' => '2025-06-10 06:02:05',
                'updated_at' => '2025-06-10 06:04:21',
                'lokasi_wawancara' => NULL,
                'interviewer' => NULL,
                'catatan_wawancara' => NULL,
            ),
            6 => 
            array (
                'id' => 9,
                'pelamar_id' => 4,
                'lowongan_id' => 17,
                'status' => 'pending',
                'jadwal_wawancara' => NULL,
                'catatan_hrd' => NULL,
                'tanggal_lamar' => '2025-06-10',
                'pesan_tambahan' => NULL,
                'created_at' => '2025-06-10 10:58:26',
                'updated_at' => '2025-06-10 10:58:26',
                'lokasi_wawancara' => NULL,
                'interviewer' => NULL,
                'catatan_wawancara' => NULL,
            ),
        ));
        
        
    }
}