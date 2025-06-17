<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'izza@gmail.com',
                'token' => '$2y$10$67rMtinSqHSn9iyRITGEPOcw7FFogjQogyMVkHJhIm2M7MFHEtYSm',
                'created_at' => '2025-06-11 07:27:33',
            ),
        ));
        
        
    }
}