<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasokBarangDetail extends Model
{
    use HasFactory;

    protected $table = 'pemasok_barang_detail';
    protected $fillable = [
        'id', 'no_faktur', 'user', 'supplier', 'item', 'jumlah', 'unit', 'nomor_po'
    ];

    public $timestamps = false;
}
