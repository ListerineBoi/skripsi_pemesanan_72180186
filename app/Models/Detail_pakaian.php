<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_pakaian extends Model
{
    protected $fillable = [
        'public','jenis','img','nama_atasan','nama_bawahan','desc','ling_b','ling_pgang','ling_pingl','ling_lh','leb_bahu','pj_lengan','ling_kr_leng','ling_lengan',
        'ling_pergel','leb_muka','leb_pungg','panj_pungg','panj_baju','tinggi_pingl','ling_pinggang','ling_pesak',
        'ling_paha','ling_lutut','ling_kaki','panj_cln_rok','tingg_dudk',
    ];
    protected $table="detail_pakaian";
    public function samp()
    {
        return $this->hasMany(Sampling::class);
    }
    public function prod()
    {
        return $this->hasMany(Produksi::class);
    }
}
