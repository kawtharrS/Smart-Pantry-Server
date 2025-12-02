<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $fillable = [
        'household_id',
        'recipe_id',
        'title',
        'description',
        'prep_time_min',
        'cook_time_min',
        'serving',
    ];

    public function instructions(): HasMany{
        return $this->hasMany(RecipesInstruction::class);
    }

    public function ingredients(): BelongsToMany{
        return $this->belongsToMany(
    Ingredient::class,
    'recipes_ingredients_table', 
    'recipe_id',           
    'ingredient_id'        
        );

    }

    public function mealPlan() {
        return $this->belongsTo(MealPlan::class);
    }

}
