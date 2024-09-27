<?php

namespace FossHaas\Courses\Database\Seeders;

use App\Models\User;
use FossHaas\Courses\Models\Activity;
use FossHaas\Courses\Models\ActivityGroup;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseGroup;
use FossHaas\Courses\Models\DownloadActivity;
use FossHaas\Courses\Models\WeblinkActivity;
use FossHaas\Courses\Services\EnrollmentService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function FossHaas\Support\getMorphFields;
use function FossHaas\Support\preciseDiffForHumans;

class FakeCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(EnrollmentService $enrollmentService): void
    {
        // TODO implement prereqs
        $time = now();
        $rootGroups = CourseGroup::factory(4)->create();
        $allCourses = collect();
        foreach ($rootGroups as $rootGroup) {
            $groups = $rootGroup->courseGroups()->createMany(
                CourseGroup::factory(3)->withParent($rootGroup)->make()->toArray()
            );
            $groups->push(...$rootGroups->take(2));
            foreach ($groups as $subGroup) {
                $courses = $subGroup->courses()->createMany(
                    Course::factory(
                        fake()->numberBetween(1, 5)
                    )->withCourseGroup($subGroup)->make()->toArray()
                );
                $allCourses->push(...$courses);
                foreach ($courses as $course) {
                    $activityGroups = $course->activityGroups()->createMany(
                        ActivityGroup::factory(
                            fake()->numberBetween(0, 1)
                        )->make()->toArray()
                    );
                    $contentFactories = [
                        DownloadActivity::factory(),
                        WeblinkActivity::factory(),
                    ];
                    $course->activities()->createMany(
                        $activityGroups
                            ->pluck('id')
                            ->push(null)
                            ->flatMap(
                                fn(string|null $activityGroupId) => Activity::factory(
                                    fake()->numberBetween(0, 2)
                                )->make(fn() => [
                                    'activity_group_id' => $activityGroupId,
                                    ...getMorphFields(
                                        fake()->randomElement($contentFactories)
                                            ->create(),
                                        'content'
                                    ),
                                ])->toArray()
                            )->toArray()
                    );
                }
            }
        }
        $numCourses = $allCourses->count();
        Log::info(sprintf(
            'Created %d courses in %d groups containing %d activities in %d groups',
            $numCourses,
            CourseGroup::count(),
            Activity::count(),
            ActivityGroup::count(),
        ), ['time' => preciseDiffForHumans($time)]);

        $time = now();
        $users = User::all();
        $numUsers = $users->count();
        Log::info(sprintf(
            'Creating up to %d enrollments for %d users',
            $numUsers * $numCourses,
            $numUsers
        ));

        $enrollments = $enrollmentService->enrollUsers($users, $allCourses);
        $numEnrollments = $enrollments->count();
        Log::info(sprintf(
            'Created %d enrollments (%d enrollments/s)',
            $numEnrollments,
            $numEnrollments / $time->diffInSeconds()
        ), ['time' => preciseDiffForHumans($time)]);

        $time = now();
        $numDeleted = (int) ceil($numEnrollments * (fake()->numberBetween(10, 25) / 100));
        $enrollmentsTable = $enrollments->first()->getTable();
        DB::table($enrollmentsTable)
            ->inRandomOrder()
            ->limit($numDeleted)
            ->delete();
        Log::info(sprintf(
            'Deleted %d enrollments (%d enrollments/s)',
            $numDeleted,
            $numDeleted / $time->diffInSeconds()
        ), ['time' => preciseDiffForHumans($time)]);

        $numEnrollments -= $numDeleted;
        $time = now();
        $numExpired = (int) ceil($numEnrollments * (fake()->numberBetween(20, 40) / 100));
        DB::table($enrollmentsTable)
            ->inRandomOrder()
            ->limit($numExpired)
            ->update(['expires_at' => now()->subMonths(2)]);
        Log::info(sprintf(
            'Expired %d enrollments (%d enrollments/s)',
            $numExpired,
            $numExpired / $time->diffInSeconds()
        ), ['time' => preciseDiffForHumans($time)]);
    }
}
