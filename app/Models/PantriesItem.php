<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PantriesItem extends Model
{
    protected $fillable = [
        'household_id', 'ingredient_id', 'quantity', 'unit_id', 'location', 'expiry_date'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
