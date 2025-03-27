<?php
namespace App\Repositories;

use App\Models\User;

class WizardRepository
{
    public function updateUserStatus($userId, $status)
    {
        return User::where('id', $userId)->update(['status' => $status]);
    }
}
