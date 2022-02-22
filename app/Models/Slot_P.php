<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot_P extends Model
{
    protected $fillable = [
        'title','mulai','selesai','status','kuota',
    ];
    protected $table='slot_p';
}
