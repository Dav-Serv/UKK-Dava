<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class produk extends Model
{
    use HasFactory;

    protected $table = "produks";
    protected $primarykey = "id";

    protected $fillable =[
        "nama_produk",
        "harga",
        "stock",
    ];

    // Relasi dengan DetailPenjualan
    public function detailpenjualan(){
        return $this->hasMany(Detailpenjualan::class, 'id', 'id_detail');
    }
}
