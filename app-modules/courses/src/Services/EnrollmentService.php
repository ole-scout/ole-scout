<?php

namespace FossHaas\Courses\Services;

use App\Models\User;
use DateTime;
use FossHaas\Courses\Actions\CreateUserVisibleCourseGroups;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\Enrollment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    public function __construct(
        private CreateUserVisibleCourseGroups $createUserVisibleCourseGroups
    ) {}
    /**
     * @param Collection<User> $users
     * @param Collection<Course> $courses
     * @return Collection<int,Enrollment>
     */
    public function enrollUsers(Collection $users, Collection $courses, ?DateTime $expires_at = null): Collection
    {
        return DB::transaction(function () use (
            $users,
            $courses,
            $expires_at
        ) {
            $enrollmentsTable = (new Enrollment())->getTable();
            $lastId = Enrollment::query()
                ->orderBy('id', 'desc')
                ->limit(1)
                ->pluck('id')
                ->first() ?? 0;
            DB::table($enrollmentsTable)
                ->insert($courses->flatMap(
                    fn($course) => $users->map(
                        fn($user) => [
                            'user_id' => $user->id,
                            'course_id' => $course->id,
                            'expires_at' => $expires_at,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    )
                )->toArray());
            $enrollments = Enrollment::with('course.courseGroup')
                ->where('id', '>', $lastId)
                ->get();
            $this->createUserVisibleCourseGroups->handle($enrollments);
            return $enrollments;
        });
    }
}