<?php

namespace FossHaas\Courses\Actions;

use FossHaas\Courses\Models\Enrollment;
use FossHaas\Courses\Models\UserVisibleCourseGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateUserVisibleCourseGroups
{
    /**
     * @param Collection<int,Enrollment> $enrollments
     * @param bool $purge
     */
    public function handle(Collection $enrollments, $purge = false): void
    {
        $userVisibleCourseGroupsTable = (new UserVisibleCourseGroup())->getTable();
        if ($purge) {
            DB::table($userVisibleCourseGroupsTable)
                ->whereIn('enrollment_id', $enrollments->pluck('id'))
                ->delete();
        }
        $pathsByCourseGroupId = $enrollments
            ->pluck('course')
            ->pluck('courseGroup')
            ->filter()
            ->unique()
            ->mapWithKeys(fn($group) => [
                $group->id => $group
                    ->ancestorsAndSelf()
                    ->pluck('id')
            ]);
        $pathsByCourseId = $enrollments
            ->pluck('course')
            ->mapWithKeys(fn($course) => [
                $course->id => $course->course_group_id ?
                    $pathsByCourseGroupId->get($course->course_group_id) : collect()
            ]);
        DB::table($userVisibleCourseGroupsTable)
            ->insert(
                $enrollments->flatMap(
                    fn($enrollment) => $pathsByCourseId
                        ->get($enrollment->course_id)
                        ->map(
                            fn($groupId) => [
                                'enrollment_id' => $enrollment->id,
                                'course_group_id' => $groupId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]
                        )
                )->toArray()
            );
    }
}
