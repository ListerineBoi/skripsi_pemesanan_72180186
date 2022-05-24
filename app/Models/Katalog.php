<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    protected $fillable = [
        'detail_id_s','detail_id_m','detail_id_l','detail_id_xl','img_depan','img_belakang','img_dll1','img_dll2','desc','title','harga','aktif',
    ];
    protected $table="katalog";
}
