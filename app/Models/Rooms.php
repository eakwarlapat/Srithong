<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    public function customer() 
    {
        return $this->hasOne(Customer::class);
    }

    public function receipt() 
    {
        return $this->hasMany(Receipt::class);
    }

    public function bill() 
    {
        return $this->hasOne(Bill::class);
    }

    // public function customer_room() 
    // {
    //     return $this->belongsTo(Customer::class);
    // }


}
