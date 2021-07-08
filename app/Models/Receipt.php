<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 
        'status', 
        'electric', 
        'water', 
        'rooms_id'
    ];

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }
}


