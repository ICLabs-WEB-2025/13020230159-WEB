<?php

namespace App\Policies;

use App\Models\Presence;
use App\Models\User;

class PresencePolicy
{
        public static function canViewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

        public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->hasRole('admin');
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Presence $presence): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Presence $presence): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Presence $presence): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Presence $presence): bool
    {
        return false;
    }
}
