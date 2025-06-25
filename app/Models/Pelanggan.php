<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pelanggan extends Model
{
    use HasFactory;

    protected $table = "pelanggans";
    protected $primarykey = "id";
    // public $incrementing = true;

    protected $fillable =[
        "nama_pelanggan",
        "alamat",
        "telephone",
    ];

    // Relasi dengan penjualan
    public function penjualan(){
        return $this->hasMany(Penjualan::class, 'id', 'id_penjualan');
    }
}