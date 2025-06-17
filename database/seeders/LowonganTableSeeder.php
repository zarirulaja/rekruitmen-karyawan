<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LowonganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lowongan')->delete();
        
        \DB::table('lowongan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'judul' => 'Senior Backend Developer',
                'deskripsi' => 'Kami mencari Backend Developer berpengalaman untuk bergabung dengan tim pengembangan kami.',
                'posisi' => 'Backend Developer',
                'tipe_pekerjaan' => 'Full-time',
                'lokasi' => 'Remote',
                'persyaratan' => '- Minimal 3 tahun pengalaman sebagai Backend Developer
- Menguasai PHP, Laravel, MySQL
- Memahami konsep REST API
- Memiliki pengalaman dengan sistem microservice',
                'tanggung_jawab' => '- Mengembangkan dan memelihara aplikasi backend
- Mengoptimalkan performa database
- Bekerja sama dengan tim frontend
- Melakukan code review',
                'gaji_min' => '15000000.00',
                'gaji_max' => '25000000.00',
                'status' => 1,
                'tanggal_tutup' => '2025-06-21',
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-06-10 06:00:55',
            ),
            1 => 
            array (
                'id' => 2,
                'judul' => 'UI/UX Designer',
                'deskripsi' => 'Bergabunglah dengan tim desain kami untuk menciptakan pengalaman pengguna yang luar biasa.',
                'posisi' => 'UI/UX Designer',
                'tipe_pekerjaan' => 'Full-time',
                'lokasi' => 'Hybrid',
                'persyaratan' => '- Minimal 2 tahun pengalaman sebagai UI/UX Designer
- Menguasai Figma dan Adobe XD
- Memahami prinsip UX dan UI
- Portfolio yang menarik',
                'tanggung_jawab' => '- Merancang antarmuka pengguna
- Melakukan user research
- Membuat wireframe dan prototype
- Bekerja sama dengan tim development',
                'gaji_min' => '12000000.00',
                'gaji_max' => '20000000.00',
                'status' => 1,
                'tanggal_tutup' => '2025-06-21',
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-06-10 06:01:04',
            ),
            2 => 
            array (
                'id' => 3,
                'judul' => 'Frontend Developer Intern',
                'deskripsi' => 'Program magang untuk mahasiswa yang tertarik dengan pengembangan frontend.',
                'posisi' => 'Frontend Developer',
                'tipe_pekerjaan' => 'Internship',
                'lokasi' => 'Onsite',
                'persyaratan' => '- Mahasiswa semester 6 ke atas
- Memahami HTML, CSS, dan JavaScript
- Memiliki minat dalam pengembangan web
- Bersedia magang minimal 3 bulan',
                'tanggung_jawab' => '- Membantu pengembangan frontend
- Belajar dan menerapkan best practices
- Bekerja dalam tim
- Menyelesaikan tugas yang diberikan',
                'gaji_min' => '2000000.00',
                'gaji_max' => '3000000.00',
                'status' => 1,
                'tanggal_tutup' => '2025-06-21',
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-06-10 06:01:10',
            ),
            3 => 
            array (
                'id' => 17,
                'judul' => 'tukang gayam',
                'deskripsi' => 'memasak',
                'posisi' => 'chef',
                'tipe_pekerjaan' => 'Internship',
                'lokasi' => 'tuban',
                'persyaratan' => 'memasak',
                'tanggung_jawab' => 'memasak',
                'gaji_min' => '5000000.00',
                'gaji_max' => '6000000.00',
                'status' => 1,
                'tanggal_tutup' => '2025-06-13',
                'created_at' => '2025-06-10 10:58:07',
                'updated_at' => '2025-06-10 10:58:07',
            ),
        ));
        
        
    }
}