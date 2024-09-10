<?php

namespace FossHaas\Courses\Database\Seeders;

use App\Models\User;
use FossHaas\Courses\Models\Activity;
use FossHaas\Courses\Models\ActivityGroup;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseGroup;
use FossHaas\Courses\Models\DownloadActivity;
use FossHaas\Courses\Models\Enrollment;
use FossHaas\Courses\Models\WeblinkActivity;
use Illuminate\Database\Seeder;

class FakeCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rootGroups = CourseGroup::factory(5)->create();
        foreach ($rootGroups as $group) {
            $subGroups = CourseGroup::factory(
                fake()->numberBetween(1, 3),
                [
                    'parent_id' => $group->id,
                ]
            )->create();
            foreach ($subGroups as $subGroup) {
                $courses = Course::factory(
                    fake()->numberBetween(2, 5),
                    [
                        'course_group_id' => $subGroup->id,
                    ]
                )->create();
                foreach ($courses as $course) {
                    $activityGroups = ActivityGroup::factory(
                        fake()->numberBetween(0, 1),
                        [
                            'course_id' => $course->id,
                        ]
                    )->create();
                    $activityGroupIds = $activityGroups->pluck('id');
                    $activityGroupIds->push(null);
                    foreach ($activityGroupIds as $activityGroupId) {
                        $downloadActivities = Activity::factory(
                            fake()->numberBetween(1, 2),
                            [
                                'course_id' => $course->id,
                                'activity_group_id' => $activityGroupId,
                            ]
                        )->create();
                        foreach ($downloadActivities as $activity) {
                            DownloadActivity::factory([
                                'activity_id' => $activity->id,
                            ])->create();
                        }
                        $weblinkActivities = Activity::factory(
                            fake()->numberBetween(1, 2),
                            [
                                'course_id' => $course->id,
                                'activity_group_id' => $activityGroupId,
                            ]
                        )->create();
                        foreach ($weblinkActivities as $activity) {
                            WeblinkActivity::factory(
                                [
                                    'activity_id' => $activity->id,
                                ]
                            )->create();
                        }
                    }
                }
                $users = User::all()->shuffle();
                foreach ($users->take(fake()->numberBetween(intval(ceil($users->count() * 0.75)), $users->count())) as $user) {
                    foreach ($courses as $course) {
                        if (fake()->numberBetween(1, 5) > 1) {
                            Enrollment::factory([
                                'user_id' => $user->id,
                                'course_id' => $course->id,
                            ])->create();
                        } else {
                            Enrollment::factory([
                                'user_id' => $user->id,
                                'course_id' => $course->id,
                            ])->expired()->create();
                        }
                    }
                }
            }
        }
    }
}
