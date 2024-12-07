<?php

namespace App\Http\Controllers\MasterData\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tapel;
use Illuminate\Http\Request;

class DataKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            return view('pages.kehadiran.index', [
                'kelas' => $kelas,
                'role' => auth()->user()->role,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role, $id)
    {
        $siswa = Siswa::where('kelas_id', $id)->where('status', 1)->get();
        return view('pages.kehadiran.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::find($id),
            'kehadiran' => Kehadiran::get(),
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role, $id)
    {
        $kelas = Kelas::find($id);
        $siswas = $request->siswa_id;
        $tapel = Tapel::where('id', $kelas->tapel_id)->first();
        $siswas = Siswa::whereIn('id', $siswas)->get()->pluck('id');

        foreach ($siswas as $i => $siswa) {
            $kehadiran = Kehadiran::whereIn('siswa_id', $siswas)->where('tapel_id', $tapel->id)->get();
            $kehadiran = $kehadiran->where('siswa_id', $siswa)->first();
            if ($kehadiran) {
                $kehadiran->update([
                    'sakit' => $request->sakit[$i],
                    'izin' => $request->izin[$i],
                    'tk' => $request->tk[$i]
                ]);
            } else {
                if ($request->sakit[$i] || $request->izin[$i] || $request->tk[$i]) {
                    Kehadiran::create([
                        'siswa_id' => $siswa,
                        'tapel_id' => $tapel->id,
                        'sakit' => $request->sakit[$i],
                        'izin' => $request->izin[$i],
                        'tk' => $request->tk[$i],
                    ]);
                }
            }
        }
        return back()->withInfo('Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
