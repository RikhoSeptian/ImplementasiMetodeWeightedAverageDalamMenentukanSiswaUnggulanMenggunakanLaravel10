<?php

namespace App\Http\Controllers\MasterData\Biodata;

use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Ekstrakurikuler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort('403');
        } else {
            return view('pages.dataguru.index', [
                'guru' => Guru::where('user_id', '!=', '1')->orderBy('name', 'ASC')->get(),
                'kelas' => Kelas::get(),
                'pembelajaran' => Pembelajaran::get(),
                'ekstrakurikuler' => Ekstrakurikuler::get(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dataguru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        $inputUser = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);
        $inputUser; // Create User
        $request['user_id'] = $inputUser->id;
        $inputGuru = $request->except(['_token', '_method', 'username', 'password']);
        Guru::create($inputGuru);
        return redirect(route('dataguru.index'))
        ->withInfo('Data Guru: <b>'.$request->name.'</b> berhasil ditambahkan!');
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
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('pages.dataguru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, $id)
    {
        Guru::find($id)->update($request->all());
        return redirect(route('dataguru.index'))->withInfo('Data Guru: <b>'.$request->name.'</b> berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Guru::find($id)->delete();
        User::where('id', $request->id)->delete();
        return redirect(route('dataguru.index'))->withInfo('Data Guru: <b>'.$request->name.'</b> berhasil dihapus!');
    }
}
