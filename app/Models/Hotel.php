<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'address',
        'location_id',
        'user_id',
        'postal_code',
        'latitude',
        'longitude',
        'rating',
        'stars',
        'phone',
        'email',
        'is_featured',
        'status',
        'image',
        'gallery',
        'video_link',
        'min_age',
        'checkin',
        'checkout',
        'cancellation_policy_id',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'gallery' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cancellationPolicy()
    {
        return $this->belongsTo(CancellationPolicy::class);
    }

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(HotelAmenity::class, 'hotel_hotel_amenity');
    }

    public function bookings()
    {
        return $this->hasMany(HotelBooking::class);
    }
}
