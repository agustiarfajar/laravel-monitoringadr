<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'ms_perusahaan';
    protected $fillable = ['perusahaan'];
}
