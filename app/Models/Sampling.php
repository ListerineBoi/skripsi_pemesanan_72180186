<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampling extends Model
{
    protected $fillable = [
        'slot_id','jml','cus_id','admin_id','status','detail_id',
    ];
    protected $table="sampling";
}
