<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot_S extends Model
{
    protected $fillable = [
        'title','mulai','selesai','status','kuota',
    ];
    protected $table="slot_s";
}
