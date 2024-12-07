<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Guru;
use App\Models\Wali;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.profile.index');
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $data = request()->except(['_token', '_method']);

        if (auth()->user()->role === 'admin') {
            Admin::where('user_id', $id)->update($data);
        }

        if (auth()->user()->role === 'guru') {
            Guru::where('user_id', $id)->update($data);
        }

        if (auth()->user()->role === 'walisiswa') {
            Wali::where('user_id', $id)->update($data);
        }

        if (auth()->user()->role === 'siswa') {
            Siswa::where('user_id', $id)->update($data);
        }
        return back()->withInfo('Profile anda berhasil diperbarui!');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'files' => 'required|image',
        ],[
            'required' => 'Tidak boleh kosong!',
            'image' => 'File harus image!'
        ]);

        $files = $request->file('files');
        if ($request->hasFile('files')) {
            $filenameWithExtension = $request->file('files')->getClientOriginalExtension();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = 'img' . time() . '.' . $extension;
            $files->move('img', $filenameSimpan);

            $editData = [
                'foto' => $filenameSimpan,
            ];

            if (auth()->user()->role == 'admin') {
                Admin::where('user_id', auth()->user()->id)->update($editData);
            } elseif (auth()->user()->role == 'guru') {
                Guru::where('user_id', auth()->user()->id)->update($editData);
            } elseif (auth()->user()->role == 'siswa') {
                Siswa::where('user_id', auth()->user()->id)->update($editData);
            } elseif (auth()->user()->role == 'walisiswa') {
                Wali::where('user_id', auth()->user()->id)->update($editData);
            } else {
                return back()->with('info', 'Foto profile gagal diperbarui!');
            }
        } 

        if ($request->oldPhoto != 'default.jpg') {
            $fileGambar = public_path('/img/' . $request->oldPhoto);
            File::delete($fileGambar);
        }

        return back()->with([
            'info' => 'Foto profil berhasil diperbarui!',
            'foto' => 'active',
        ]);
    }

    public function updateAkun(Request $request, $id)
    {
        $akun = User::find($id);
        $request->validate([
            'username' => 'required|unique:users,username,' . $akun->id,
        ],[
            'required' => 'Tidak boleh kosong!',
            'unique' => 'Username sudah ada!',
        ]);

        if ($request->filled('password')) {
            $request['password'] = bcrypt($request->password);
            $akun->update($request->all());
        } else {
            $akun->update($request->except('password'));
        }

        return back()->withInfo('Data Akun berhasil diperbarui!');
    }
}
