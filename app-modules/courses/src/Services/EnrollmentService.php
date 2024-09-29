<?php

namespace FossHaas\Courses\Services;

use App\Models\User;
use Closure;
use DateTime;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\Enrollment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    /**
     * @param Collection<User> $users
     * @param Collection<Course> $courses
     * @return Collection<int,Enrollment>
     */
    public function enrollUsers(Collection $users, Collection $courses, DateTime|Closure|null $expires_at = null): Collection
    {
        return DB::transaction(function () use (
            $users,
            $courses,
            $expires_at
        ) {
            $lastId = Enrollment::query()
                ->orderBy('id', 'desc')
                ->limit(1)
                ->pluck('id')
                ->first() ?? 0;
            Enrollment::query()
                ->insert($courses->flatMap(
                    fn($course) => $users->map(
                        fn($user) => [
                            'user_id' => $user->id,
                            'course_id' => $course->id,
                            'expires_at' => $expires_at && $expires_at instanceof Closure ? $expires_at($user->id, $course->id) : $expires_at,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    )
                )->toArray());
            return Enrollment::where('id', '>', $lastId)->get();
        });
    }
}
