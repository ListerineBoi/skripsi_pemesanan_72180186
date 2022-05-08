<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'jasa_id','cus_id','user_id','jenis'
    ];
    protected $table="room";

    public function jasa()
    {
    return $this->belongsTo(Jasa::class, 'jasa_id');
    }
    public function messageslatest()
    {
    return $this->hasOne(Message::class)->latestOfMany();
    }
}
