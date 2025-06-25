<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(){
        $produks = Produk::all();

        return view("produk.index", compact('produks'));
    }

    public function create(){
        return view('produk.create');
    }
    
    public function store(Request $request){

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);

        Produk::create([
            'nama_produk' => $request->nama,
            'harga' => $request->harga,
            'stock' => $request->stock,
        ]);

        return redirect()->route('produk.index')->with('success','Data Produk Berhasil Ditambah');
    }

    public function edit($id){
        $produks = Produk::findOrFail($id);

        return view("produk.edit", compact('produks'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);

        Produk::whereId($id)->update([
            'nama_produk' => $request->nama,
            'harga' => $request->harga,
            'stock' => $request->stock,
        ]);

        return redirect()->route('produk.index')->with('success','Data Produk Berhasil Diupdate');
    }

    public function destroy($id){
        $data = Produk::findOrFail($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('produk.index')->with('success','Data Produk Berhasil Dihapus');
    }
}
