<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index(Request $request){
            $pelanggans = Pelanggan::all();

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create(){
        return view('pelanggan.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat,
            'telephone' => $request->tlp,
        ]);

        return redirect()->route('pelanggan.index')->with('success','Data Pelanggan Berhasil Ditambah');
    }

    public function edit($id){
        $pelanggans = Pelanggan::findOrFail($id);

        return view("pelanggan.edit", compact('pelanggans'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);

        Pelanggan::whereId($id)->update([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat,
            'telephone' => $request->tlp,
        ]);

        return redirect()->route('pelanggan.index')->with('success','Data Pelanggan Berhasil Diupdate');
    }

    public function destroy($id){
        $data = Pelanggan::findOrFail($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('pelanggan.index')->with('success','Data Pelanggan Berhasil Dihapus');
    }

}
