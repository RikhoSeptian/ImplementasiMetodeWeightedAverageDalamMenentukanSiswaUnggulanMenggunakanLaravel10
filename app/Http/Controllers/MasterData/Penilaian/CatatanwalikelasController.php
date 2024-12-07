<?php

namespace App\Http\Controllers\MasterData\Penilaian;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Catatanwalikelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatatanwalikelasController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'walisiswa' || auth()->user()->role === 'siswa') {
            abort('403');
        } else {

            if (auth()->user()->role == 'admin') {
                $kelas = Kelas::get();
            } else {
                $kelas = Kelas::where('guru_id', auth()->user()->guru->id)->get();
            }
            return view('pages.catatan.index', [
                'kelas' => $kelas,
                'role' => auth()->user()->role,
            ]);
        }
    }

    public function edit($role, $id)
    {
        $siswa = Siswa::where('kelas_id', $id)->where('status', 1)->get();
        return view('pages.catatan.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::where('id', $id)->first(),
            'catatan' => Catatanwalikelas::get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);
        $siswas = $request->siswa_id;
        $siswas = Siswa::whereIn('id', $siswas)->get()->pluck('id');

        foreach ($siswas as $i => $siswa) {
            $catatan = Catatanwalikelas::whereIn('siswa_id', $siswas)->get();
            $catatan = $catatan->where('siswa_id', $siswa)->first();
            if ($catatan) {
                $catatan->update([
                    'catatan' => $request->catatan[$i],
                ]);
            } else {
                if ($request->catatan[$i]) {
                    Catatanwalikelas::create([
                        'siswa_id' => $siswa,
                        'catatan' => $request->catatan[$i],
                    ]);
                }
            }
        }
        return back()->withInfo('Data berhasil diperbarui!');
    }
}
