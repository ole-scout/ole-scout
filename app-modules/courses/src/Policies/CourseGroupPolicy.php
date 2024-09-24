<?php

namespace FossHaas\Courses\Policies;

use App\Models\User;
use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;

class CourseGroupPolicy
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
    public function view(User $user, CourseGroup $courseGroup): bool|null
    {
        if ($courseGroup->isVisible($user)) {
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
    public function update(User $user, CourseGroup $courseGroup): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CourseGroup $courseGroup): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CourseGroup $courseGroup): bool|null
    {
        return null;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CourseGroup $courseGroup): bool|null
    {
        return null;
    }
}
