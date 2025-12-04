<?php

namespace App\Services\User;

use App\Models\PantriesItem;

class PantryItemsService
{
    public function getAllPantryItemsByHousehold($householdId)
    {
        return PantriesItem::with('ingredient')
            ->where('household_id', $householdId)
            ->get();
    }

    public function getPantryItemByIdAndHousehold($id, $householdId)
    {
        return PantriesItem::with('ingredient')
            ->where('household_id', $householdId)
            ->findOrFail($id);
    }

    public function create()
    {
        return new PantriesItem;
    }

    public function update($id, array $data)
    {
        $pantryItem = PantriesItem::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    public function delete($id)
    {
        $pantryItem = PantriesItem::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
