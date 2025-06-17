<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PelamarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pelamar')->delete();
        
        \DB::table('pelamar')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'nama_lengkap' => 'Ahmad Rizky',
                'email' => 'ahmad@example.com',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'pendidikan_terakhir' => 'S1',
                'jurusan' => 'Teknik Informatika',
                'universitas' => 'Universitas Indonesia',
                'tahun_lulus' => 2023,
                'cv_path' => 'cv/ahmad_cv.pdf',
                'pengalaman_kerja' => 'Software Developer di PT ABC (2023-2024),UI/UX Di PT BCA (2020-2021)',
                'skill' => 'PHP, Laravel, MySQL, JavaScript, Figma',
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-05-24 06:53:40',
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'telepon' => '082345678901',
                'alamat' => 'Jl. Sudirman No. 45, Bandung',
                'pendidikan_terakhir' => 'S1',
                'jurusan' => 'Sistem Informasi',
                'universitas' => 'Institut Teknologi Bandung',
                'tahun_lulus' => 2022,
                'cv_path' => 'cv/budi_cv.pdf',
                'pengalaman_kerja' => 'Web Developer di PT XYZ (2022-2023)',
                'skill' => 'HTML, CSS, JavaScript, React',
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-05-21 09:46:12',
            ],
            [
                'id' => 3,
                'user_id' => 4,
                'nama_lengkap' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'telepon' => '083456789012',
                'alamat' => 'Jl. Gatot Subroto No. 67, Surabaya',
                'pendidikan_terakhir' => 'S1',
                'jurusan' => 'Teknik Komputer',
                'universitas' => 'Institut Teknologi Sepuluh Nopember',
                'tahun_lulus' => 2023,
                'cv_path' => 'cv/citra_cv.pdf',
                'pengalaman_kerja' => 'UI/UX Designer di PT DEF (2023-2024)',
                'skill' => 'Figma, Adobe XD, UI/UX Design',
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-05-21 09:46:12',
            ],
            [
                'id' => 4,
                'user_id' => 5,
                'nama_lengkap' => 'izza',
                'email' => 'izza@gmail.com',
                'telepon' => '085904390140',
                'alamat' => 'driyorejo gresik',
                'pendidikan_terakhir' => 'D3',
                'jurusan' => 'Informatika',
                'universitas' => 'academy cryptod',
                'tahun_lulus' => 2010,
                'cv_path' => 'cv/cv_683c8986b8b87_5.pdf',
                'pengalaman_kerja' => 'Dosen Informatika Universitas Indonesia (2018-2019),tukang mancing',
                'skill' => 'trading cryptod,mancing,gamers apex legend',
                'created_at' => '2025-05-21 13:12:02',
                'updated_at' => '2025-06-01 17:10:30',
            ],
            [
                'id' => 5,
                'user_id' => 9,
                'nama_lengkap' => 'notzariel',
                'email' => 'test123@gmail.com',
                'telepon' => '0812121212',
                'alamat' => '',
                'pendidikan_terakhir' => 'Tidak disebutkan',
                'jurusan' => 'Tidak disebutkan',
                'universitas' => 'Tidak disebutkan',
                'tahun_lulus' => 2025,
                'cv_path' => 'cv/cv_6847ca5c98411_9.pdf',
                'pengalaman_kerja' => 'Tidak ada',
                'skill' => 'Belum ada',
                'created_at' => '2025-06-10 05:58:54',
                'updated_at' => '2025-06-10 06:02:05',
            ],
            [
                'id' => 6,
                'user_id' => 10,
                'nama_lengkap' => 'a.zarirul ilmi s',
                'email' => '22081010162@student.upnjatim.ac.id',
                'telepon' => '085904390140',
                'alamat' => '',
                'pendidikan_terakhir' => 'Tidak disebutkan',
                'jurusan' => 'Tidak disebutkan',
                'universitas' => 'Tidak disebutkan',
                'tahun_lulus' => 2025,
                'cv_path' => '',
                'pengalaman_kerja' => 'Tidak ada',
                'skill' => 'Belum ada',
                'created_at' => '2025-06-10 06:19:29',
                'updated_at' => '2025-06-10 06:19:29',
            ],
        ]);
    }
}
