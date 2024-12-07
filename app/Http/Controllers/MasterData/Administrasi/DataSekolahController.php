<?php

namespace App\Http\Controllers\MasterData\Administrasi;

use App\Models\Sekolah;
use App\Http\Controllers\Controller;
use App\Http\Requests\SekolahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DataSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort('403');
        } else {
            $sekolah = Sekolah::first();
            return view('pages.datasekolah.index', compact('sekolah'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SekolahRequest $request)
    {
        Sekolah::create($request->all());

        return redirect(route('datasekolah.index'))->withInfo('Data Sekolah berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SekolahRequest $request, $id)
    {
        Sekolah::find($id)->update($request->all());

        return redirect(route('datasekolah.index'))->withInfo('Data Sekolah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateLogo(Request $request, $id) 
    {
        $request->validate([
            'files' => ['image', 'required'],
        ]);
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            $filenameWithExtension = $request->file('files')->getClientOriginalExtension();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenamesimpan = 'logo'.time().'.'.$extension;
            $files->move('img', $filenamesimpan);

            $editdata = [
                'logo' => $filenamesimpan,
            ];

            Sekolah::find($id)->update($editdata);
        }
        if ($request->old_logo != 'logo.png') {
            $filegambar = public_path('/img/'.$request->old_logo);
            File::delete($filegambar);
        }

        return back()->withInfo('Logo sekolah berhasil diperbarui!');
    }
}
