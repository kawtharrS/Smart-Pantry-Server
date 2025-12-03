<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
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
        $household = $this->householdService->create(
            $request->user_id,
            $request->name,
            $request->invite_code
        );

        if ($household)
            return $this->responseJSON($household);

        return $this->responseJSON(null, "failure", 400);
    }


    function deleteHousehold($id)
    {
        $household = $this->householdService->delete($id);
        if($household)
        {
            return $this->responseJSON($household, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }

    public function join(Request $request)
    {
        $request->validate([
            'invite_code' => 'required|string'
        ]);

        $userId = Auth::id(); 
        $inviteCode = $request->invite_code;

        $joined = $this->householdService->join($userId, $inviteCode);

        if ($joined['status'] === 'success') {
            return $this->responseJSON($joined['household'], "success", 200);
        }

        return $this->responseJSON(null, $joined['message'], 400);
    }



}
