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
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CourseGroup $courseGroup): bool
    {
        return CourseGroup::forUser($user)->where('id', $courseGroup->id)->exists();
    }

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
    public function update(User $user, CourseGroup $courseGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CourseGroup $courseGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CourseGroup $courseGroup): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CourseGroup $courseGroup): bool
    {
        return false;
    }
}
