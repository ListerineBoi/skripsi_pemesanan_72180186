<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsul extends Model
{
    protected $fillable = [
        'samp_id','prod_id','title','tgl','mulai','status','jenis','link'
    ];
    protected $table="konsul";
}
