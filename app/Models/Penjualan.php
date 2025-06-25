<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penjualan extends Model
{
    use HasFactory;

    protected $table = "penjualans";
    protected $primarykey = "id";

    protected $fillable =[
        "tanggal_jual",
        "total_harga",
        "id_pelanggan",
        "status",
    ];

    // Relasi dengan Pelanggan
    public function pelanggan() : BelongsTo {
        return $this->BelongsTo(Pelanggan::class, "id_pelanggan", "id");
    }

    // Relasi dengan Detailpenjualan
    public function detailpenjualan(){
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id');
    }
}
