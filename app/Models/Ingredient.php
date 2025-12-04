<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name', 'calories_per_100g', 'protein_per_100g', 'fats_per_100g', 'carbs_per_100g', 'unit_id'
    ];
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
    public function pantryItems()
    {
        return $this->hasMany(PantriesItem::class);
    }
}
