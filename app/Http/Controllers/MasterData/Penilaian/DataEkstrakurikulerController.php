<?php

namespace App\Http\Controllers\MasterData\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\AnggotaEkskul;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Tapel;
use Illuminate\Http\Request;

class DataEkstrakurikulerController extends Controller
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
            if (auth()->user()->role === 'admin') {
                $ekskul = Ekstrakurikuler::get();
            } else {
                $ekskul = Ekstrakurikuler::where('guru_id', auth()->user()->guru->id)->get();
            }
            return view('pages.dataekstrakurikuler.index', [
                'ekskul' => $ekskul,
                'siswa' => Siswa::get(),
                'guru' => Guru::get(),
                'tapel' => Tapel::get(),
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
        $validate = $request->validate([
            'name' => 'required|unique:ekstrakurikulers',
            'tapel_id' => 'required',
            'guru_id' => 'required|unique:ekstrakurikulers',
        ]);
        Ekstrakurikuler::create($validate);
        return back()
        ->withInfo('Data Ekstrakurikuler: <b>' . $request->name . '</b> berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $ekskul = Ekstrakurikuler::find($id);
        $anggotaEkskul = AnggotaEkskul::where('ekstrakurikuler_id', $id)->get();
        return view('pages.dataekstrakurikuler.show', [
            'anggota' => $anggotaEkskul,
            'ekskul' => AnggotaEkskul::find($id),
            'ekstrakurikuler' => $ekskul,
            'siswa' => Siswa::where('status', 1)->orderBy('name')->get(),
        ]);
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
    public function update(Request $request, $role, $id)
    {
        $validate = $request->validate([
            'tapel_id' => 'required',
            'guru_id' => 'required',
            'name' => 'required',
        ]);
        Ekstrakurikuler::find($id)->update($validate);
        return back()->withInfo('Data Ekstrakurikuler: <b>' . $request->name . '</b> berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role, $id)
    {
        $ekskul = Ekstrakurikuler::find($id);
        $ekskul->delete();
        return back()->withInfo('Data Ekstrakurikuler: <b>' . $ekskul->name . '</b> berhasil dihapus!');
    }

    public function storeAnggota(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'ekstrakurikuler_id' => 'required',
            // 'predikat' => 'required',
        ]);

        $anggotaEkskul = AnggotaEkskul::where('siswa_id', $request->siswa_id)->get()->pluck('ekstrakurikuler_id');
        $ekskulSiswaId = Ekstrakurikuler::whereIn('id', $anggotaEkskul)->pluck('id');
        $reqEkskulId = $request->ekstrakurikuler_id; //2
        $ekskul = Ekstrakurikuler::where('id', $reqEkskulId)->first();

        if ($ekskulSiswaId->contains($reqEkskulId)) {
            return back()->withFailed('Siswa tersebut sudah masuk ekstrakukurikuler: <b>' . $ekskul->name . '</b>');
        } else {
            AnggotaEkskul::create($request->all());
            return back()->withInfo('Siswa tersebut telah berhasil ditambahkan ke Ekskul <b>' . $ekskul->name . '</>!');
        }
    }

    public function destroyAnggota($id)
    {
        $anggota = AnggotaEkskul::find($id);
        $anggota->delete();
        return back()->withInfo('Siswa: <b>' . $anggota->siswa->name . '</b> telah berhasil dihapus dari Ekskul: <b>' . $anggota->ekstrakurikuler->name . '</b>!');
    }
}
