<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Household;
use App\Services\User\HouseholdService;
class HouseholdController extends Controller
{
    public function __construct(protected HouseholdService $householdService)
    {}
    function getAllHouseholds()
    {
        $Households = $this->householdService->getAllHouseholds();
        return $this->responseJSON($Households);
    }

    function show($id)
    {
        $Household = $this->householdService->getHouseholdById($id);
        return $this->responseJSON($Household);
    }

    function updateHousehold(Request $request, $id)
    {
        $Household = $this->householdService->update($id, $request->all());
        if($Household)
            return $this->responseJSON($Household, "success", 200);
        return $this->responseJSON($Household, "failure", 400);
    }

    function createHousehold(Request $request)
    {
        $Household = $this->householdService->create();
        $Household->name = $request["name"];
        $Household->invite_code = $request["invite_code"];

        if($Household->save())
            return $this->responseJSON($Household);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteHousehold($id)
    {
        $Household = $this->householdService->delete($id);
        if($Household)
        {
            return $this->responseJSON($Household, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }

}
