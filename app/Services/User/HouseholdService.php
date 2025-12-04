<?php

namespace App\Services\User;

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

    public function create()
    {
        return new Household;
    }

    function update($id, array $data)
    {
        $household = Household::findOrFail($id);
        $household->update($data);
        return $household;
    }

    function delete($id)
    {
        $household = Household::findOrFail($id);
        $household->delete();
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