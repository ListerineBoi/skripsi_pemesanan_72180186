<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $fillable = [
        'slot_id','detail_id','desc','jml','cus_id','admin_id','status',
    ];
    protected $table="produksi";
    public function room()
    {
        return $this->hasMany(Room::class);
    }
    public function detp()
    {
        return $this->belongsTo(Detail_pakaian::class,'detail_id');
    }
}
