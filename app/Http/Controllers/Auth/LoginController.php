<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function cekLogin(Request $request)
    {
        $input = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($input)) {
            $siswa = auth()->user()->siswa;
            $role = auth()->user()->role;

            if ($role === 'siswa' && $siswa->status === '2') {
                Auth::logout(); // Logout user yang tidak aktif
                return back()->withInfo('Akun tidak aktif. Silakan hubungi TU.');
            }
            
            return redirect($role.'/dashboard')->with('login', $role);
        } else {
            return back()->withInfo('Username atau Password salah!');
        }
    }
}
