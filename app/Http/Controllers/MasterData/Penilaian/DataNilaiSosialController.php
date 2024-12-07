<?php

namespace App\Http\Controllers\MasterData\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\NilaiSosial;
use App\Models\Siswa;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataNilaiSosialController extends Controller
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
            return view('pages.nilaisosial.index', [
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
        return view('pages.nilaisosial.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::find($id),
            'nilaiSosial' => NilaiSosial::get(),
            'role' => Auth::user()->role,
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
            $nilaiSosial = NilaiSosial::whereIn('siswa_id', $siswas)->where('tapel_id', $tapel->id)->get();
            $nilaiSosial = $nilaiSosial->where('siswa_id', $siswa)->first();
            if ($nilaiSosial) {
                $nilaiSosial->update([
                    'siswa_id' => $siswa,
                    'tapel_id' => $tapel->id,
                    'predikat' => $request->predikat[$i],
                    'deskripsi' => $request->deskripsi[$i]
                ]);
            } else {
                if ($request->predikat[$i] || $request->deskripsi[$i]) {
                    NilaiSosial::create([
                        'siswa_id' => $siswa,
                        'tapel_id' => $tapel->id,
                        'predikat' => $request->predikat[$i],
                        'deskripsi' => $request->deskripsi[$i],
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
