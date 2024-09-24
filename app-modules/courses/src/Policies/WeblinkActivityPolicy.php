<?php

namespace FossHaas\Courses\Policies;

use App\Models\User;
use FossHaas\Courses\Models\WeblinkActivity;
use Illuminate\Auth\Access\Response;

class WeblinkActivityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WeblinkActivity $weblinkActivity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WeblinkActivity $weblinkActivity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WeblinkActivity $weblinkActivity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WeblinkActivity $weblinkActivity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WeblinkActivity $weblinkActivity): bool|null
    {
        return null;
    }
}
