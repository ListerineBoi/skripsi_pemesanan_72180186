<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'samp_id','prod_id','jenis_jasa','jenis_pembayaran','img_bukti','file_invoice','status',
    ];
    protected $table="pembayaran";
}
