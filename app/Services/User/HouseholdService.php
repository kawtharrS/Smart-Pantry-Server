<?php

namespace App\Services\Household;
use App\Models\Household;
class HouseholdService
{
   function getAllHouseholds()
    {
        return Household::all();
    }

    function getHouseholdById($id)
    {
        return Household::findOrFail($id);
    }

    function create()
    {
        return new Household;
    }

    function update($id, array $data)
    {
        $Household = Household::findOrFail($id);
        $Household->update($data);
        return $Household;
    }

    function delete($id)
    {
        $Household = Household::findOrFail($id);
        $Household->delete();
        return true;
    }
}
