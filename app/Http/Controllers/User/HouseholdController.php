<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\HouseholdService;

class HouseholdController extends Controller
{
    public function __construct(protected HouseholdService $householdService)
    {}
    
    function getAllHouseholds()
    {
        $households = $this->householdService->getAllHouseholds();
        return $this->responseJSON($households);
    }

    function show($id)
    {
        $household = $this->householdService->getHouseholdById($id);
        return $this->responseJSON($household);
    }

    function updateHousehold(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'invite_code' => 'sometimes|max:50|unique:households,invite_code,' . $id
        ]);

        $household = $this->householdService->update($id, $validated);
        
        if($household)
            return $this->responseJSON($household, "success", 200);
        
        return $this->responseJSON($household, "failure", 400);
    }

    function createHousehold(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'invite_code' => 'required|max:50|unique:households,invite_code'
        ]);

        $userId = Auth::id();
        $household = $this->householdService->create();
        $household->user_id = $userId;
        $household->name = $validated['name'];
        $household->invite_code = $validated['invite_code'];


        if ($household->save())
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
        return $this->responseJSON(null, "failure", 400); 
    }

    public function join(Request $request)
    {
        $validated = $request->validate([
            'invite_code' => 'required|string|max:50'
        ]);

        $userId = Auth::id(); 
        $joined = $this->householdService->join($userId, $validated['invite_code']);

        if ($joined['status'] === 'success') {
            return $this->responseJSON($joined['household'], "success", 200);
        }

        return $this->responseJSON(null, $joined['message'], 400);
    }
}