<?php

namespace App\Http\Controllers\Raport;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\NilaiAkhir;
use App\Models\Pembelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $kelas = Kelas::get();
        } elseif (auth()->user()->role == 'guru') {
            $kelas = Kelas::where('guru_id', auth()->user()->guru->id)->get();
        } elseif (auth()->user()->role == 'siswa') {
            $kelas = Kelas::where('id', auth()->user()->siswa->kelas_id)->get();
        } 
        // elseif (auth()->user()->role == 'walisiswa') {
        //     $kelas = Kelas::where('id', auth()->user()->walisiswa->siswa->kelas_id)->get();
        // }
        return view('pages.nilaiakhir.index', [
            'kelas' => $kelas,
            'role' => auth()->user()->role,
        ]);
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
    public function show($role, $id)
    {
        $kelas = Kelas::find($id);
        $pembelajaran = Pembelajaran::where('kelas_id', $id)->get()->pluck('mapel_id');
        $mapel = Mapel::whereIn('id', $pembelajaran)->get();

        if (auth()->user()->role === 'admin' || auth()->user()->role === 'guru') {
            $siswa = Siswa::where('kelas_id', $id)->where('status', 1)->orderBy('name', 'ASC')->get();
        } elseif (auth()->user()->role === 'siswa') {
            $siswa = Siswa::where('kelas_id', $id)->where('user_id', auth()->user()->id)->where('status', 1)->orderBy('name', 'ASC')->get();
        } elseif (auth()->user()->role === 'walisiswa') {
            $siswa = Siswa::where('kelas_id', $id)->where('id', auth()->user()->walisiswa->siswa_id)->where('status', 1)->orderBy('name', 'ASC')->get();
        }

        $nilaiAkhir = NilaiAkhir::get();

        $rataRata = [];
        $ranking = [];

        foreach ($siswa as $item) {
            $rataRataSiswa = $nilaiAkhir->where('siswa_id', $item->id)->avg('rata_rata');
            $rataRata[] = $rataRataSiswa;
        }

        arsort($rataRata);
        $rank = 1;
        foreach ($rataRata as $siswaId => $nilai) {
            $ranking[$siswaId] = $rank;
            $rank++;
        }

        return view('pages.nilaiakhir.show', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'nilaiAkhir' => $nilaiAkhir,
            'mapel' => $mapel,
            'pembelajaran' => $pembelajaran,
            'pemb' => Pembelajaran::get(),
            'rataRata' => $rataRata,
            'ranking' => $ranking,
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
    public function destroy($id)
    {
        //
    }
}
