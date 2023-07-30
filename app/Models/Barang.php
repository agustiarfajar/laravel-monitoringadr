<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Perusahaan;
use App\Models\PengirimanHoDetail;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'id', 'user', 'id_perusahaan', 'pic', 'pemasok', 'item', 'jumlah', 'unit', 'nomor_po', 'tgl_kedatangan', 'created_at', 'updated_at'
    ];
}
