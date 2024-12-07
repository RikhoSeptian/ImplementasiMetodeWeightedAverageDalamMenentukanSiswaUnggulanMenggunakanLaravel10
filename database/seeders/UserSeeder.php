<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [ //1
              'username' => 'administrator',
              'email' => 'admin@gmail.com',
              'role' => 'admin',
              'password' => Hash::make('password'),
            ],
            // [ 
            //   'username' => 'Guru',
            //   'email' => 'guru@gmail.com',
            //   'role' => 'guru',
            //   'password' => bcrypt('password'),
            // ],
            // [ 
            //   'username' => 'Wali',
            //   'email' => 'wali@gmail.com',
            //   'role' => 'walisiswa',
            //   'password' => bcrypt('password'),
            // ],
            // [ 
            //   'username' => 'Siswa',
            //   'email' => 'siswa@gmail.com',
            //   'role' => 'siswa',
            //   'password' => bcrypt('password'),
            // ],
        ])->each(function($user){
            User::create($user);
        });
    }
}
