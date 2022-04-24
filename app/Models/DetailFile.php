<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'img','detail_id',
    ];
    protected $table="detail_file";
}
