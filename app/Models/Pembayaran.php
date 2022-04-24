<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'samp_id','prod_id','jenis_jasa','jenis_pembayaran','sarana_p','img_bukti','file_invoice','status','terbayar',
    ];
    protected $table="pembayaran";
    public function nota()
    {
        return $this->hasMany(Nota::class,'bayar_id');
    }
    public function sampling()
    {
    return $this->belongsTo(Sampling::class, 'samp_id');
    }
    public function produksi()
    {
    return $this->belongsTo(Produksi::class, 'prod_id');
    }
}
