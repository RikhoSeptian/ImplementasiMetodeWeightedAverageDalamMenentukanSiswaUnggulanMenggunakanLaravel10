<?php

namespace App\Http\Controllers\MasterData\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataPrestasiController extends Controller
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
            $prestasi = Prestasi::get();
            $siswa = Siswa::where('status', 1)->orderBy('name', 'ASC')->get();
            return view('pages.dataprestasi.index', [
                'prestasi' => $prestasi,
                'siswa' => $siswa,
                'role' => Auth::user()->role,
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
    public function store(Request $request, $role)
    {
        $req = $request->validate([
            'siswa_id' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
        ]);

        $prestasi = Prestasi::create($req);
        $prestasi;
        return back()
        ->withInfo('Prestasi Siswa: <b>' . $prestasi->siswa->name . '</b> berhasil ditambahkan!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role, $id)
    {
        $prestasi = Prestasi::find($id);
        $prestasi->delete();
        return back()->withInfo('Data Prestasi: <b>' . $prestasi->siswa->name . ' - ' . $prestasi->keterangan . '</b> berhasil dihapus!');
    }
}
