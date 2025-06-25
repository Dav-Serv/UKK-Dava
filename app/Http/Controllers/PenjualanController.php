<?php
namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index(){
        // Mengambil semua data penjualan dengan informasi pelanggan
        $penjualans = Penjualan::with('pelanggan')->get();

        // Mengirim data penjualan ke view
        return view('penjualan.index', compact('penjualans'));
    }

    public function create(){
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        return view('penjualan.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'pelanggan'               => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        // Mengatur tanggal dan waktu penjualan sesuai perangkat
        $tanggaljual = Carbon::now()->toDateTimeString(); // Menggunakan Carbon untuk mendapatkan waktu saat ini

        $penjualan = new Penjualan();
        $penjualan->tanggal_jual = $tanggaljual;
        $penjualan->id_pelanggan = $request->pelanggan;
        $penjualan->status = 1; // Default Belum Bayar Setelah Memesan Produk
        $penjualan->total_harga = 0; // akan dihitung setelah detail penjualan disimpan
        $penjualan->save();

        $totalharga = 0;

        // Simpan detail penjualan
        foreach ($request->produk as $item) {
            $produk = Produk::find($item['ProdukID']);
            $subtotal = $produk->harga * $item['JumlahProduk'];

            $detailPenjualan = new Detailpenjualan();
            $detailPenjualan->id_penjualan = $penjualan->id;
            $detailPenjualan->id_produk = $item['ProdukID'];
            $detailPenjualan->jumlah_produk = $item['JumlahProduk'];
            $detailPenjualan->subtotal = $subtotal;
            $detailPenjualan->save();

            // Tambahkan subtotal ke total harga
            $totalharga += $subtotal;

            // Kurangi stok produk
            $produk->stock -= $item['JumlahProduk'];
            $produk->save();
        }

        // Update total harga penjualan
        $penjualan->total_harga = $totalharga;
        $penjualan->save();

        return redirect()->route('penjualan.index')->with('success','Data Penjualan Berhasil Ditambah');
    }

    
    public function pelunasan($id){
        $penjualan = Penjualan::with('detailPenjualan.Produk')->findOrFail($id);
        $detail = DetailPenjualan::all();
        $produks = Produk::all(); // Ambil semua produk untuk dropdown
        $pelanggans = Pelanggan::all(); // Ambil semua pelanggan untuk dropdown
        return view('penjualan.pelunasan', compact('penjualan', 'pelanggans', 'produks', 'detail'));
    }

    
    public function lunas(Request $request, $id){

        // Temukan penjualan berdasarkan ID
        $penjualan = Penjualan::findOrFail($id);

        $penjualan->status = 0;
        $penjualan->save();

        return redirect()->route('penjualan.index')->with('success','Data Penjualan Berhasil Dilunasi');;

    }

    public function show($id){
        // Ambil data penjualan beserta detail penjualannya
        $penjualan = Penjualan::with('detailpenjualan')->findOrFail($id);

        // Kirim data ke view
        return view('penjualan.show', compact('penjualan'));
    }

    public function kwitansi($id){
        $penjualan = Penjualan::with(['pelanggan', 'detailpenjualan.produk'])->findOrFail($id);
        return view('penjualan.kwitansi', compact('penjualan'));
    }

    public function destroy($id){
        // Hapus semua detail penjualan terkait terlebih dahulu
        DetailPenjualan::where('id_penjualan', $id)->delete();

        // Kemudian hapus data penjualan
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();


        return redirect()->route('penjualan.index')->with('success','Data Penjualan Berhasil Dihapus');
    }

    public function cancel($id){
    // Ambil semua detail penjualan berdasarkan ID penjualan
    $detailPenjualans = DetailPenjualan::where('id_penjualan', $id)->get();

    // Mengedit stok produk
    foreach ($detailPenjualans as $detail) {
        $produk = Produk::find($detail->ProdukID);
        if ($produk) { // Pastikan produk ditemukan
            $produk->Stok += $detail->JumlahProduk;
            $produk->save();
        }
    }

    // Hapus semua detail penjualan terkait
    DetailPenjualan::where('id_penjualan', $id)->delete();

    // Hapus data penjualan
    Penjualan::where('id', $id)->delete();

    return redirect()->route('penjualan.index')->with('success', 'Data Penjualan Berhasil Dibatalkan.');
}

}
