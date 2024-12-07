<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'user_id' => 1,
                'name' => 'Administrator',
                'gelar' => 'S.Kom.,M.Kom.',
                // 'nip' => '123456789012345678',
                'nuptk' => '123456789012345678',
                'jk' => 'L',
                'tempatlahir' => 'Bandung',
                'tanggallahir' => '2002-09-25',
                'telepon' => '08231312123',
                'alamat' => 'Jl. Pasar Sayati Lama, Bandung',
            ],
        ])->each(function ($guru) {
            Guru::create($guru);
        });
    }
}
