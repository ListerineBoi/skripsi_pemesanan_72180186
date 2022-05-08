<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'jasa_id','jenis_jasa','jenis_pembayaran','sarana_p','img_bukti','file_invoice','status','terbayar',
    ];
    protected $table="pembayaran";
    public function nota()
    {
        return $this->hasMany(Nota::class,'bayar_id');
    }
    public function jasa()
    {
    return $this->belongsTo(Jasa::class, 'jasa_id');
    }
}
