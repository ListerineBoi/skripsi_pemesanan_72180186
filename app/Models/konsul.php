<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsul extends Model
{
    protected $fillable = [
        'samp_id','prod_id','title','tgl','mulai','status','jenis','link'
    ];
    protected $table="konsul";
    public function sampling()
    {
    return $this->belongsTo(Sampling::class, 'samp_id');
    }
    public function produksi()
    {
    return $this->belongsTo(Produksi::class, 'prod_id');
    }
}
