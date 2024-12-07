<?php

namespace App\Http\Controllers\MasterData\Biodata;

use App\Models\User;
use App\Models\Wali;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\NilaiPas;
use App\Models\NilaiPts;
use App\Models\Prestasi;
use App\Models\Kehadiran;
use App\Models\NilaiAkhir;
use App\Models\NilaiSosial;
use App\Models\AnggotaEkskul;
use App\Models\NilaiSpiritual;
use App\Models\Catatanwalikelas;
use App\Models\NilaiPengetahuan;
use App\Models\NilaiKeterampilan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Imports\SiswaImport;
use App\Models\Guru;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'siswa') {
            abort('403');
        } else {
            return view('pages.datasiswa.index', [
                'siswa' => Siswa::orderBy('name', 'ASC')->get(),
                'role' => Auth::user()->role,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.datasiswa.create', [
            'kelas' => Kelas::orderBy('tingkat', 'ASC')->orderBy('name', 'ASC')->get(),
            'role' => Auth::user()->role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $inputUser = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);
        $inputUser;
        $request['user_id'] = $inputUser->id;
        $inputSiswa = $request->except(['_token', '_method', 'username', 'password']);
        Siswa::create($inputSiswa);
        $role = Auth::user()->role;
        return redirect(route('datasiswa.index', $role))->withInfo('Data siswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($role, $id)
    {
        // Membatasi akses hanya untuk peran selain 'admin' dan 'siswa'
        if (Auth::user()->role === 'admin' || auth()->user()->role === 'siswa') {
            abort(403); // Menghentikan akses jika bukan role yang diizinkan
        } else {
            // Mencari kelas berdasarkan ID yang diberikan
            $kelas = Kelas::find($id);

            // Mengambil data siswa berdasarkan kelas
            $siswa = Siswa::where('kelas_id', $kelas->id)->orderBy('name', 'ASC')->get();

            // Mengembalikan tampilan dengan data siswa dan kelas
            return view('pages.datasiswa.show', [
                'siswa' => $siswa,
                'kelas' => $kelas,
                'role' => Auth::user()->role,
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($role, $id)
    {
        return view('pages.datasiswa.edit', [
            'siswa' => Siswa::find($id),
            'kelas' => Kelas::get(),
            'role' => Auth::user()->role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, $role, $id)
    {
        Siswa::find($id)->update($request->all());
        return redirect(route('datasiswa.index', ['datakelas' => $id, 'role' => $role]))->withInfo('Data Siswa: <b>' . Str::before($request->name, ' ') . '</b> berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $role, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        User::where('id', $request->user_id)->delete();
        AnggotaEkskul::where('siswa_id', $id)->delete();
        Catatanwalikelas::where('siswa_id', $id)->delete();
        Kehadiran::where('siswa_id', $id)->delete();
        NilaiPas::where('siswa_id', $id)->delete();
        NilaiPts::where('siswa_id', $id)->delete();
        NilaiSosial::where('siswa_id', $id)->delete();
        NilaiSpiritual::where('siswa_id', $id)->delete();
        NilaiPengetahuan::where('siswa_id', $id)->delete();
        NilaiKeterampilan::where('siswa_id', $id)->delete();
        Prestasi::where('siswa_id', $id)->delete();
        NilaiAkhir::where('siswa_id', $id)->delete();
        return redirect(route('datasiswa.index', ['datasiswa' => $id, 'role' => $role]))->withInfo('Data Siswa: <b>' . Str::before($siswa->name, ' ') . '</b> berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => [ 'file', 'distinct']
        ]);

        $file = $request->file('file');
        if ($file->getClientOriginalExtension() != 'xlsx') {
            return back()->withFailed('Import Gagal! File yang anda masukkan tidak sesuai ketentuan!');
        }

        DB::beginTransaction();

        try {
            Excel::import(new SiswaImport, request()->file('file'));
            DB::commit(); 
        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->withFailed('Import Gagal! silahkan periksa kembali!');
        }

        return redirect()->back()->with('info', 'Data siswa berhasil diimport!');
    }

    public function downloadTemplate($filename)
    {
        $filePath = public_path('files/' . $filename);

        // Memeriksa apakah file ada di direktori public
        if (file_exists($filePath)) {
            // Mengunduh file
            return Response::download($filePath);
        }

        // Jika file tidak ditemukan, kembali dengan pesan error
        return back()->with('failed', 'File tidak ditemukan!');
    }
}
