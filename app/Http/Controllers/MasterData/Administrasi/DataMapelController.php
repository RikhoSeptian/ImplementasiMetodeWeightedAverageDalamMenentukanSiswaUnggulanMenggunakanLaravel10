<?php

namespace App\Http\Controllers\MasterData\Administrasi;

use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\Pembelajaran;
use App\Http\Requests\MapelRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort('403');
        } else {
            $mapel = Mapel::get();
            $pembelajaran = Pembelajaran::get();
            return view('pages.datamapel.index', compact('mapel','pembelajaran'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.datamapel.create', [
            'tapel' => Tapel::orderBy('tahun_pelajaran', 'ASC')->orderBy('semester')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MapelRequest $request)
    {
        Mapel::create($request->all());
        return redirect(route('datamapel.index'))
        ->withInfo('Data Mapel: <b>'.$request->name.'</b> berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('pages.datamapel.show',[
            'mapel' => Mapel::find($id),
            'pembelajaran' => Pembelajaran::where('mapel_id', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pages.datamapel.edit', [
            'mapel' => Mapel::find($id),
            'tapel' => Tapel::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mapelDiEdit = Mapel::find($id);
        $request->validate([
            'name' => 'required|unique:mapels,name,'.$mapelDiEdit->id,
        ]);

        $mapelDiEdit->update($request->all());
        return redirect(route('datamapel.index'))->withInfo('Data Mapel: <b>'.$request->name.'</b> berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Mapel::find($id)->delete();
        return redirect(route('datamapel.index'))->withInfo('Data Mapel: <b>'.$request->name.'</b> berhasil dihapus!');
    }
}
