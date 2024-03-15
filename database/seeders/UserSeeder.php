<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@rs.com',
                'password' => bcrypt('abcde'),
                'role' => 'admin',
            ],
            [
                'name' => 'User Pegawai',
                'email' => 'pegawai@rs.com',
                'password' => bcrypt('abcde'),
                'role' => 'pegawai',

            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
