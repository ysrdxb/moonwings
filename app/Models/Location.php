<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'country_id' , 'city_id', 'status', 'latitude', 'longitude'];

    /**
     * Get the country that owns the location.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Get the city that owns the location.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }    
}
