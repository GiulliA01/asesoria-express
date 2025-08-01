<?php


namespace App\Observers;

use App\Models\User;

class UserObserver
{
    // Cuando un usuario se cree
    public function creating(User $user)
    {
        if (auth()->check()) {
            $user->created_by = auth()->id();
        }
    }

    // Cuando un usuario se actualice
    public function updating(User $user)
    {
        if (auth()->check()) {
            $user->updated_by = auth()->id();
        }
    }
}
