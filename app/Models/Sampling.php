<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampling extends Model
{
    protected $fillable = [
        'slot_id','cus_id','admin_id','status','detail_id',
    ];
    protected $table="sampling";
    public function room()
    {
        return $this->hasMany(Room::class);
    }
    public function detp()
    {
        return $this->belongsTo(Detail_pakaian::class,'detail_id');
    }
}
