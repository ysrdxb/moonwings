<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAmenity extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_hotel_amenity');
    }
}
