<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message','room_id'];
    use HasFactory;
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    public function admin()
    {
    return $this->belongsTo(admin::class);
    }
}
