<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = [
        'jenis','title','mulai','selesai','status','kuota',
    ];
    protected $table="slot";
}
