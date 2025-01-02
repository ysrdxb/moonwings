<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function visas()
    {
        return $this->hasMany(Visa::class, 'country_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
