<?php

namespace FossHaas\Courses\Database\Seeders;

use App\Models\User;
use Carbon\CarbonInterval;
use FossHaas\Courses\Models\Activity;
use FossHaas\Courses\Models\ActivityGroup;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseGroup;
use FossHaas\Courses\Models\DownloadActivity;
use FossHaas\Courses\Models\Enrollment;
use FossHaas\Courses\Models\WeblinkActivity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class FakeCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getMorphFields = fn($model, string $name) => [
            $name . '_id' => $model->id,
            $name . '_type' => $model->getMorphClass(),
        ];
        $time = now();
        $rootGroups = CourseGroup::factory(5)->create();
        $allCourses = collect();
        foreach ($rootGroups as $rootGroup) {
            $groups = $rootGroup->courseGroups()->createMany(
                CourseGroup::factory(
                    fake()->numberBetween(1, 3)
                )->make()->toArray()
            );
            $groups->push(
                ...$rootGroups->shuffle()->take(fake()->numberBetween(2, 3))
            );
            foreach ($groups as $subGroup) {
                $courses = $subGroup->courses()->createMany(
                    Course::factory(
                        fake()->numberBetween(2, 5)
                    )->make()->toArray()
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
                        $activityGroups->pluck('id')->push(null)->flatMap(
                            fn(string|null $activityGroupId) => Activity::factory(
                                fake()->numberBetween(0, 2)
                            )->make(fn() => [
                                'activity_group_id' => $activityGroupId,
                                ...$getMorphFields(
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
        Log::info('Created ' . $allCourses->count() . ' courses', [
            'time' => CarbonInterval::milliseconds(intval($time->diffInMilliseconds()))->cascade()->forHumans(),
        ]);
        $count = User::count();
        $users = User::all()->shuffle();
        Log::info('Creating up to ' . $count * $allCourses->count() . ' enrollments for ' . $count . ' users');
        $total = 0;
        $started = now();
        foreach ($allCourses as $i => $course) {
            $time = now();
            $enrollments = $course->enrollments()->createMany(
                $users->take(
                    intval(ceil($count * fake()->randomFloat(min: 0.75, max: 0.9)))
                )->map(function (User $user) {
                    $enrollment = Enrollment::factory([
                        'user_id' => $user->id
                    ]);
                    if (fake()->randomFloat() > 0.2) {
                        $enrollment = $enrollment->expired();
                    }
                    return $enrollment->make()->toArray();
                })->toArray()
            );
            $total += $enrollments->count();
            $remaining = (($allCourses->count() - 1 - $i) * $count);
            $speed = $total / $started->diffInSeconds();
            Log::info(sprintf(
                'Created %d enrollments (%d %%)',
                $enrollments->count(),
                (($i + 1) / $allCourses->count()) * 100
            ), [
                'time' => CarbonInterval::milliseconds(intval($time->diffInMilliseconds()))->cascade()->forHumans(),
                'speed' => sprintf('%d enrollments/s', $speed),
                'remaining' => CarbonInterval::seconds(intval(
                    $remaining / $speed
                ))->cascade()->forHumans(),
            ]);
        }
    }
}
