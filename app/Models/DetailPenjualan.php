<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detailpenjualan extends Model
{
    use HasFactory;

    protected $table = "detailpenjualans";
    protected $primarykey = "id";

    protected $fillable =[
        "id_penjualan",
        "id_produk",
        "jumlah_produk",
        "subtotal",
    ];

    public function penjualan() : BelongsTo {
        return $this->BelongsTo(Penjualan::class, "id_penjualan","id");
    }

    public function produk() : BelongsTo {
        return $this->BelongsTo(Produk::class, "id_produk","id");
    }
}
