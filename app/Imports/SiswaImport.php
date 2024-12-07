<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    $user = User::create([
      'username' => $row[1],
      'email' => $row[0],
      'role' => 'siswa', // Anda bisa mengganti role sesuai kebutuhan
      'password' => Hash::make($row[2]), // Anda bisa mengubah cara enkripsi password sesuai konfigurasi
    ]);
    $user;

    // Menyimpan data ke dalam tabel siswas
    $siswa = new Siswa([
      'user_id' => $user->id,
      'kelas_id' => $row[3] ?: null, // Jika kosong, set ke null
      'name' => $row[6],
      'jk' => $row[7] ?: null,
      'jenispendaftaran' => $row[8] ?: null,
      'diterimapada' => $row[9] ?: null,
      'nis' => $row[4] ?: null,
      'nisn' => $row[5] ?: null, // Tetap 0000000000 jika kosong
      'tempatlahir' => $row[10] ?: null,
      'tanggallahir' => $row[11] ?: null,
      'agama' => $row[12] ?: null,
      'statusdalamkeluarga' => $row[13] ?: null,
      'anak_ke' => $row[14] ?: null,
      'alamat' => $row[15] ?: null,
      'telepon' => $row[16] ?: null,
      'namaayah' => $row[17] ?: null,
      'namaibu' => $row[18] ?: null,
      'pekerjaanayah' => $row[19] ?: null,
      'pekerjaanibu' => $row[20] ?: null,
      'namawali' => $row[21] ?: null,
      'pekerjaanwali' => $row[22] ?: null,
    ]);
  
    return $siswa;
  }

  // Tentukan baris pertama data yang akan diimpor (misalnya, baris judul tidak diimpor)
  public function startRow(): int
  {
    return 10;
  }
}
