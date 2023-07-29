<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'ms_ekspedisi';
    protected $fillable = ['ekspedisi', 'alamat', 'telpon', 'pic-eks'];
}
