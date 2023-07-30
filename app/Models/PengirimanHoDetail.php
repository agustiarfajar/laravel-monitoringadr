<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanHoDetail extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_ho_detail';
    protected $fillable = [
        'id', 'no_faktur', 'user', 'pemasok', 'id_barang', 'item', 'unit', 'jumlah', 'nomor_po', 'tgl_kedatangan' 
    ];

    public $timestamps = false;
}
