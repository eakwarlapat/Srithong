<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cus_name', 
        'cus_surname', 
        'cus_tel', 
        'cus_email', 
        'cus_add', 
        'personalid',
        'rent_status', 
        'rooms_id'];

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }

    public static function findByCus_id(string $id): ?Customer
    {
        return static::where('id', $id)->with('rooms')->get()->first();
    }

    public static function withRoomNumber()
    {
        return static::where('id')->with('rooms')->get();
    }
}
