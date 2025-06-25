<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    // Function Login
    public function index(){
        return view('Auth.Login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('failed','Email Atau Password Salah');
        }
    }

    // Function Logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Kamu Berhasil Logout');
    }

    // Function Registrasi
    public function register(){
        return view('Auth.Register');
    }

    public function register_proses(Request $request){
        $request->validate([
            'nama'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:6',
        ]);

        $data['name'] = $request->nama;
        $data['level'] = 'user';
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $login = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($login)){
            return redirect()->route('login')->with('success','Kamu Berhasil Register');
        }
    }
}
