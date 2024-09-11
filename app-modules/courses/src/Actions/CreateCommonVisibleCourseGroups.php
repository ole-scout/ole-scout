<?php

namespace FossHaas\Courses\Actions;

use FossHaas\Courses\Enums\Access;
use FossHaas\Courses\Models\Course;
use Illuminate\Support\Collection;

class CreateCommonVisibleCourseGroups
{
    /**
     * @param Collection<int,Course> $courses
     * @param bool $purge
     */
    public function handle(Collection $courses, $purge = false): void
    {
        if ($purge) {
            $courses->each(function (Course $course) {
                $course->commonVisibleCourseGroups()->delete();
            });
        }
        $courses->each(function (Course $course) {
            if (
                $course->course_group_id === null ||
                $course->access === Access::HIDDEN
            ) {
                return;
            }
            $groups = $course->courseGroup->ancestorsAndSelf()->get();
            $course->commonVisibleCourseGroups()->createMany(
                $groups->map(fn($group) => ['course_group_id' => $group->id])
            );
        });
    }
}
