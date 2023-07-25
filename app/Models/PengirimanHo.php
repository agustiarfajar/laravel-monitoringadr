<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanHo extends Model
{
    use HasFactory;
    protected $table = 'pengiriman_ho';
    protected $fillable = [
        'id', 'no_faktur', 'id_perusahaan', 'pic', 'ekspedisi', 'tgl_surat_jalan', 'tgl_diterima_site', 'status', 'created_at', 'updated_at'
    ];
    
}
