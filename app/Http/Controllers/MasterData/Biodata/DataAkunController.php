<?php

namespace App\Http\Controllers\MasterData\Biodata;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAkunRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort('403');
        } else {
            return view('pages.dataakun.index', [
                'akun' => User::where('role', '!=', 'admin')->get(),
            ]);
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
    public function store(Request $request)
    {
        //
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
        $akun = User::find($id);
        return view('pages.dataakun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAkunRequest $request, $id)
    {
        $akun = User::find($id);
        $request->validate([
            'username' => 'required|unique:users,username,' . $akun->id,
        ],[
            'required' => 'Tidak boleh kosong!',
            'unique' => 'Username sudah ada!',
        ]);

        if ($request->filled('password')) {
            $request['password'] = Hash::make($request->password);
            $akun->update($request->all());
        } else {
            $akun->update($request->except('password'));
        }
        return redirect(route('dataakun.index'))->withInfo('Data Akun berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
