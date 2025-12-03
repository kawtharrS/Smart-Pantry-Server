<?php

namespace App\Services\User;
use App\Models\Household;
use Illuminate\Support\Facades\Auth;

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

    public function create($userId, $name, $inviteCode)
    {
        $household = new Household();
        $household->name = $name;
        $household->invite_code = $inviteCode;
        $household->save();

        $household->users()->attach($userId);

        return $household;
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
public function join($userId, $inviteCode)
{
    $household = Household::where('invite_code', $inviteCode)->first();

    if (!$household) {
        return [
            'status' => 'error',
            'message' => 'Invalid invite code.'
        ];
    }

    if ($household->users()->where('user_id', $userId)->exists()) {
        return [
            'status' => 'success',
            'household' => $household
        ];
    }

    $household->users()->attach($userId);

    return [
        'status' => 'success',
        'household' => $household
    ];
}


}
