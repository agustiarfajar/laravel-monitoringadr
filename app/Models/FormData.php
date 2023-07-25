<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $fillable = ['perusahaan', 'pic', 'ekspedisi', 'user', 'suplier', 'item', 'jumlah', 'unit', 'nomor'];
    protected $fill = ['perusahaan', 'pic', 'ekspedisi'];

    public static function deleteById($id)
    {
        self::where('id', $id)->delete();
    }
}


