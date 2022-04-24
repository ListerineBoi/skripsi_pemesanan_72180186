<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'bayar_id','jenis_pembayaran','img_bukti','file_nota',
    ];
    protected $table="nota";
    use HasFactory;
}
