<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'month', 
        'status', 
        'internet',
        'electric', 
        'water', 
        'rooms_id',
        'room_price'
    ];

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }
}
