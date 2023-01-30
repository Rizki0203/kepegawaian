<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $user = User::create([
            'nidn'       => '1234567890',
            'name'        => 'Super Admin',
            'email'       => 'super@admin.com',
            'password'    => bcrypt('password'),
            'role'        => 'admin',
            'image'       => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
        ]);


    }
}
