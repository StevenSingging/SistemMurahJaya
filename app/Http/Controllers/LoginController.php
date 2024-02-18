<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postlogin (Request $request){
        //dd($request->all());
        $input=$request->all();
        if(auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))){
            if(auth()->user()->role=='Pegawai'){
                return redirect('dashboard/karyawan');
            }else if(auth()->user()->role=='Admin'){
                return redirect('dashboard/admin');
            }
        }
        return redirect('/')->with('postlogin','Username atau Password Anda Salah, Silakan lakukan proses login kembali');
    }

    public function logout (Request $request){
        Auth::logout();
        return redirect('/')->with('logout','Anda berhasil logout');
    }
}
