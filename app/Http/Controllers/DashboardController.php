<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Informasi;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($role)
    {
        if (Auth::user()->role != $role) {
            return back();
        }

        $admin = Auth::user()->admin;
        $guru = Auth::user()->guru;
        $wali = Auth::user()->wali;
        $siswa = Auth::user()->siswa;

        if (Auth::user()->role == 'admin') {
            $informasi = Informasi::latest()->limit(5)->get();
        } else {
            $informasi = Informasi::where('untuk', auth()->user()->role)->latest()->limit(3)->get();
        }

        $cSiswa = Siswa::get()->count();
        $cGuru = Guru::get()->count();
        $cEkstrakurikuler = Ekstrakurikuler::get()->count();
        $cMapel = Mapel::get()->count();
        $cKelas = Kelas::get()->count();
        
        return view('pages.dashboard.index', compact('role', 'admin', 'guru', 'siswa', 'wali', 'informasi', 'cSiswa', 'cGuru', 'cEkstrakurikuler', 'cMapel', 'cKelas'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req = $request->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'untuk' => 'required',
        ]);

        $informasi = Informasi::create($req);
        $informasi;
        return back()->withInfo('Informasi berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Informasi::find($id)->delete();

        return back()->withInfo('Informasi berhasil dihapus!');
    }
}
