<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message','room_id'];
    use HasFactory;
    protected $casts = [
        'created_at'  => 'date:Y-m-d H:i:s',
    ];
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    public function admin()
    {
    return $this->belongsTo(admin::class);
    }
}
