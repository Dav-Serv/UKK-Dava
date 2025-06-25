<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\middleware;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\User;

class HomeController extends Controller
{

    public function dashboard(){
        $totalTransaksiPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalRegister = User::count();
        $totalPelanggan = Pelanggan::count();

        return view('dashboard', compact('totalTransaksiPenjualan', 'totalProduk', 'totalRegister', 'totalPelanggan'));
    }

    public function index(){
        // handle ke model
        $data = User::get();
        // return view ke pengguna
        return view('index', compact('data'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama'      => 'required',
            'level'     => 'required',
            'email'     => 'required|email',
            'password'  => 'required|min:6',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name']       = $request->nama;
        $data['level']      = $request->level;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);

        $user = User::create($data);

        return redirect()->route('user.index')->with('success','Data User Berhasil Ditambah');
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('edit',compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'nama'      => 'required',
            'level'     => 'nullable',
            'email'     => 'required|email',
            'password'  => 'nullable',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email']      = $request->email;
        $data['level']      = $request->level;
        $data['name']       = $request->nama;

        if($request->password){
            $data['password']   = Hash::make($request->password);
        }

        $user = User::whereId($id)->update($data);
        // $user->assignRole('pelanggan');

        return redirect()->route('user.index')->with('success','Data User Berhasil Diupdate');
    }

    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('user.index')->with('success','Data User Berhasil Dihapus');
    }
}
