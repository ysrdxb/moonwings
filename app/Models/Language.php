<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code' , 'is_default', 'status', 'direction'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_guides')
                    ->withPivot('language_id')
                    ->withTimestamps();
    }
}
