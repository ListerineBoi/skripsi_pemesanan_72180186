<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'prod_id','samp_id','cus_id','user_id','jenis'
    ];
    protected $table="room";

    public function sampling()
    {
    return $this->belongsTo(Sampling::class, 'samp_id');
    }
    public function produksi()
    {
    return $this->belongsTo(Produksi::class, 'prod_id');
    }
}
