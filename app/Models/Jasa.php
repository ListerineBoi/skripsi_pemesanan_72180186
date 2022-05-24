<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $fillable = [
        'jenis_jasa','slot_id','detail_id','jml','cus_id','admin_id','status','permintn',
    ];
    protected $table="jasa";
    public function room()
    {
        return $this->hasMany(Room::class);
    }
    public function detp()
    {
        return $this->belongsTo(Detail_pakaian::class,'detail_id');
    }
}
