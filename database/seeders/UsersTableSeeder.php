<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'HRD Admin',
                'email' => 'hrd@winnicode.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$i0WJjY7MXNdXVD8nYLWAP.UGIr88.1IpIZPl0QBHH475yIy5luxmy',
                'role' => 'hrd',
                'remember_token' => NULL,
                'created_at' => '2025-05-21 09:46:11',
                'updated_at' => '2025-05-21 09:46:11',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ahmad Rizky',
                'email' => 'ahmad@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Q9eHo2KAJhe41P/YcDTZdeJEqxwOXFViUom04kTEaKT5yCX10H4Je',
                'role' => 'pelamar',
                'remember_token' => NULL,
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-05-21 09:46:12',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$lZC168qcAL29JEFGMAP97O3KDfC8kRhqk9YK.sQrq7vhC5k7T/XaS',
                'role' => 'pelamar',
                'remember_token' => NULL,
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-05-21 09:46:12',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ZsuR9UYyASM6G83ujMAlYekDBBGcI4UUJjuDl.pssttTxUGOqoSTi',
                'role' => 'pelamar',
                'remember_token' => NULL,
                'created_at' => '2025-05-21 09:46:12',
                'updated_at' => '2025-05-21 09:46:12',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'izza',
                'email' => 'izza@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$mrYY4/JI0CucdYrFD1b7kOHMAz14nlVpKFVTUFypIGrDBSY79NJtW',
                'role' => 'pelamar',
                'remember_token' => 'c1j6ccbaQ8tkovI8lAj0SOgMUgZGMgnLXGtDNrxYFWfJ8UBkG1mzIw1vlviW',
                'created_at' => '2025-05-21 13:12:02',
                'updated_at' => '2025-06-10 12:02:34',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'notzariel',
                'email' => 'test123@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$0pAwWnvj5K23wp3AHGEdqurF9e68e9Kgk7b2TUyK37vBymXLANQKS',
                'role' => 'pelamar',
                'remember_token' => NULL,
                'created_at' => '2025-06-10 05:58:54',
                'updated_at' => '2025-06-10 05:58:54',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'a.zarirul ilmi s',
                'email' => '22081010162@student.upnjatim.ac.id',
                'email_verified_at' => NULL,
                'password' => '$2y$10$dmApnq3nc/8lyE6T3ez4dOiLOrtBNeI1GDRggJSHtBb7UrKjwqlka',
                'role' => 'pelamar',
                'remember_token' => 'O754EsYW4EJDls018wDifN1zD36CDJcVz5sYADspxcaD1iWgHQEXfMtpOeoD',
                'created_at' => '2025-06-10 06:19:29',
                'updated_at' => '2025-06-10 06:22:29',
            ),
        ));
        
        
    }
}