<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'household_user');
    }
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function mealplans()
    {
        return $this->hasMany(MealPlan::class);
    }


}
