<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function default_language()
    {
        return $this->belongsTo(Language::class, 'default_language_id');
    }

    public function default_currency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }    
}
