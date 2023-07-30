<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasokBarang extends Model
{
    use HasFactory;

    protected $table = 'pemasok_barang';
    protected $fillable = [
        'id', 'no_faktur', 'id_perusahaan', 'pic', 'id_ekspedisi', 'pemasok', 'alamat', 'telpon', 'tgl_surat_jalan', 'tgl_kirim_pemasok', 'tgl_diterima_site', 'status', 'created_at', 'updated_at'
    ];
}
