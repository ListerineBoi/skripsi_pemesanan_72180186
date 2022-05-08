<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsul extends Model
{
    protected $fillable = [
        'jasa_id','title','tgl','mulai','status','jenis','link'
    ];
    protected $table="konsul";
    public function jasa()
    {
    return $this->belongsTo(Jasa::class, 'jasa_id');
    }
}
