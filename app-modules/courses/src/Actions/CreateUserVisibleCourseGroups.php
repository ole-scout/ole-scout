<?php

namespace FossHaas\Courses\Actions;

use FossHaas\Courses\Models\Enrollment;
use Illuminate\Support\Collection;

class CreateUserVisibleCourseGroups
{
    /**
     * @param Collection<int,Enrollment> $enrollments
     * @param bool $purge
     */
    public function handle(Collection $enrollments, $purge = false): void
    {
        if ($purge) {
            $enrollments->each(function (Enrollment $enrollment) {
                $enrollment->userVisibleCourseGroups()->delete();
            });
        }
        $enrollments->groupBy('course_id')->each(function (Collection $enrollments) {
            $sample = $enrollments->first();
            $group = $sample->course->courseGroup;
            if (!$group) return;
            $groupIds = $group->ancestorsAndSelf()->get()->pluck('id');
            $enrollments->each(function (Enrollment $enrollment) use ($groupIds) {
                $enrollment->userVisibleCourseGroups()->createMany(
                    $groupIds->map(fn($groupId) => ['course_group_id' => $groupId])
                );
            });
        });
    }
}
