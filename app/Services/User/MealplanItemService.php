<?php

namespace App\Services\User;
use App\Models\MealPlanItem;
class MealplanItemService
{
    function getAll()
    {
        return MealPlanItem::all();
    }

    function getById($id)
    {
        return MealPlanItem::findOrFail($id);
    }

    function create()
    {
        return new MealPlanItem;
    }

    function update($id, array $data)
    {
        $pantryItem = MealPlanItem::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = MealPlanItem::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
