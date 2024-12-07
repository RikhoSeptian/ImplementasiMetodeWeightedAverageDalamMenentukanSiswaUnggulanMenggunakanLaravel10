<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Raport\NilaiAkhirController;
use App\Http\Controllers\MasterData\Biodata\DataGuruController;
use App\Http\Controllers\MasterData\Biodata\DataAkunController;
use App\Http\Controllers\MasterData\Biodata\DataSiswaController;
use App\Http\Controllers\MasterData\Administrasi\DataKelasController;
use App\Http\Controllers\MasterData\Administrasi\DataTapelController;
use App\Http\Controllers\MasterData\Administrasi\DataMapelController;
use App\Http\Controllers\MasterData\Penilaian\DataPrestasiController;
use App\Http\Controllers\MasterData\Penilaian\DataKehadiranController;
use App\Http\Controllers\MasterData\Administrasi\DataSekolahController;
use App\Http\Controllers\MasterData\Penilaian\DataNilaiSosialController;
use App\Http\Controllers\MasterData\Penilaian\CatatanwalikelasController;
use App\Http\Controllers\MasterData\Penilaian\DataPembelajaranController;
use App\Http\Controllers\MasterData\Penilaian\DataNilaiSpiritualController;
use App\Http\Controllers\MasterData\Penilaian\DataEkstrakurikulerController;
use App\Http\Controllers\Raport\CetakRaportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function (User $role) {
    if (Auth::check()) {
        $role = Auth::user()->role;
        return redirect($role . '/dashboard');
    } else {
        return redirect('/login');
    }
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'cekLogin'])->name('login')->middleware('guest');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/{role}/dashboard', [DashboardController::class, 'index']);
    Route::post('/informasi/create', [DashboardController::class, 'store'])->name('informasi.store');
    Route::delete('/informasi/{id}', [DashboardController::class, 'destroy'])->name('informasi.destroy');

    /* --- Biodata --- */
    Route::get('/download/{filename}', [DataSiswaController::class, 'downloadTemplate'])->name('file.download');
    Route::post('/siswa/import', [DataSiswaController::class, 'import'])->name('datasiswa.import');
    Route::resource('/{role}/datasiswa', DataSiswaController::class);
    Route::resource('/admin/dataguru', DataGuruController::class);
    Route::resource('/admin/dataakun', DataAkunController::class);
    
    /* --- Administrasi --- */
    Route::resource('/admin/datasekolah', DataSekolahController::class);
    Route::put('/admin/datasekolah/logoupdate/{id}', [DataSekolahController::class,'updateLogo'])->name('logosekolah.update');
    Route::resource('/admin/datatapel', DataTapelController::class);
    Route::resource('/{role}/datakelas', DataKelasController::class);
    Route::resource('/admin/datamapel', DataMapelController::class);

    /* --- Penilaian --- */
    Route::resource('/{role}/datapembelajaran', DataPembelajaranController::class);
    Route::put('/datapembelajaran/{id}/insertnilai', [DataPembelajaranController::class, 'insertNilai'])->name('datapembelajaran.insertnilai');
    Route::resource('/{role}/nilaisosial', DataNilaiSosialController::class);
    Route::resource('/{role}/nilaispiritual', DataNilaiSpiritualController::class);
    Route::resource('/{role}/kehadiran', DataKehadiranController::class);
    Route::resource('/{role}/catatan', CatatanwalikelasController::class);
    Route::resource('/{role}/dataekstrakurikuler', DataEkstrakurikulerController::class);
    Route::delete('/anggotaekskul/{id}', [DataEkstrakurikulerController::class, 'destroyAnggota'])->name('anggotaekskul.destroy');
    Route::post('/anggotaekskul', [DataEkstrakurikulerController::class, 'storeAnggota'])->name('anggotaekskul.store');
    Route::resource('/{role}/dataprestasi', DataPrestasiController::class);

    /* --- Raport --- */
    Route::resource('/{role}/nilaiakhir', NilaiAkhirController::class);
    Route::resource('/{role}/cetakraport', CetakRaportController::class);
    Route::get('/cetakraport/{id}/{nisn}', [CetakRaportController::class, 'print'])->name('cetakraport.print');

    /* --- Pengaturan --- */
    Route::get('/{role}/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::put('/updateprofile/{id}', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/updatefoto/{id}', [ProfileController::class, 'updatePhoto'])->name('foto.update');
    Route::put('/updateakun/{id}', [ProfileController::class, 'updateAkun'])->name('akunsaya.update');
    Route::post('/logout', LogoutController::class);

});