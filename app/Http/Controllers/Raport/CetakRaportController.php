<?php

namespace App\Http\Controllers\Raport;

use App\Models\Siswa;
use App\Models\Tapel;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Prestasi;
use App\Models\Kehadiran;
use App\Models\NilaiAkhir;
use App\Models\NilaiSosial;
use App\Models\AnggotaEkskul;
use App\Models\NilaiSpiritual;
use App\Models\Catatanwalikelas;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CetakRaportController extends Controller
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
        } elseif (auth()->user()->role == 'walisiswa') {
            $kelas = Kelas::where('id', auth()->user()->walisiswa->siswa->kelas_id)->get();
        } elseif (auth()->user()->role == 'siswa') {
            $kelas = Kelas::where('id', auth()->user()->siswa->kelas_id)->get();
        }

        return view('pages.cetakraport.index', [
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
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'guru') {
            $siswa = Siswa::where('kelas_id', $id)->where('status', 1)->orderBy('name', 'ASC')->get();
        } elseif (auth()->user()->role === 'siswa') {
            $siswa = Siswa::where('kelas_id', $id)->where('status', 1)->where('user_id', auth()->user()->id)->orderBy('name', 'ASC')->get();
        } elseif (auth()->user()->role === 'walisiswa') {
            $siswa = Siswa::where('kelas_id', $id)->where('status', 1)->where('id', auth()->user()->walisiswa->siswa_id)->orderBy('name', 'ASC')->get();
        }
        return view('pages.cetakraport.show', [
            'siswa' => $siswa,
            'kelas' => Kelas::find($id),
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

    public function print(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $bagiraport = Tapel::where('id', $siswa->kelas->tapel->id)->first();
        $pdf = Pdf::loadview('pages.cetakraport.print', [
            'sekolah' => Sekolah::first(),
            'siswa' => $siswa,
            'nilaiakhirs' => NilaiAkhir::where('siswa_id', $id)->get(),
            // 'nilaiakhir_mapelA' =>
            'bagiraport' => $bagiraport,
            'nilai_sosial' => NilaiSosial::where('siswa_id', $id)->first(),
            'nilai_spiritual' => NilaiSpiritual::where('siswa_id', $id)->first(),
            'anggotaekskul' => AnggotaEkskul::where('siswa_id', $id)->get(),
            'prestasisiswa' => Prestasi::where('siswa_id', $id)->get(),
            'kehadiran_siswa' => Kehadiran::where('siswa_id', $id)->first(),
            'catatan_wali_kelas' => Catatanwalikelas::where('siswa_id', $id)->first(),
        ])->setPaper('Folio', 'potrait');


        if ($bagiraport->tanggalbagiraport == '' || $bagiraport->tempatbagiraport == '') {
            return back()->withFailed('Data yang akan dicetak belum lengkap!');
        }
        return $pdf->stream($siswa->name . ' - ' . $siswa->kelas->name . ' TP ' . $siswa->kelas->tapel->tahun_pelajaran . ' Semester ' . $siswa->kelas->tapel->semester . '.pdf');
    }
}
