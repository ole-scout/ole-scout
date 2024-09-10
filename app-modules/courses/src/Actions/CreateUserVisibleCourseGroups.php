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
            $groups = $group->ancestorsAndSelf()->get();
            $enrollments->each(function (Enrollment $enrollment) use ($groups) {
                $enrollment->userVisibleCourseGroups()->createMany(
                    $groups->map(fn($group) => [
                        'course_group_id' => $group->id,
                        // 'user_id' => $enrollment->user_id,
                    ])
                );
            });
        });
    }
}
