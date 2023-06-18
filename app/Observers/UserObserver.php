<?php

namespace App\Observers;

use App\Models\User;
use Exception;

class UserObserver
{
    /**
     * Handle the User "deleted" event.
     */
    public function deleting(User $user): void
    {
        try {
            $user->apointments()->delete();
            $user->staff_apointments()->update(['employee_id' => null]);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
