<?php

namespace FossHaas\Courses\Policies;

use App\Models\User;
use FossHaas\Courses\Models\Activity;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class ActivityPolicy
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
    public function view(User $user, Activity $activity): bool|null
    {
        if (
            $user->can('view', $activity->course) &&
            $user->can('view', $activity->content) !== false
        ) {
            return true;
        }
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
    public function update(User $user, Activity $activity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Activity $activity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Activity $activity): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Activity $activity): bool|null
    {
        return null;
    }
}
