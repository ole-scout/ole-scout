<?php

namespace FossHaas\Courses\Services;

use FossHaas\Courses\Models\CourseState;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseStateService
{
    public function createStatesForCourses(Collection $courses, ?Collection $users = null): Collection
    {
        return DB::transaction(function () use ($courses, $users) {
            $user_ids = ($users === null) ? collect([Auth::id()]) : $users->pluck('id');
            $activityStates = $courses->mapWithKeys(
                fn($course) => [
                    $course->id => json_encode(
                        $course->activities->mapWithKeys(fn($activity) => [
                            $activity->id => [
                                'is_required' => $activity->is_required,
                                'completed_at' => null,
                                'content_state' => method_exists(
                                    $activity->content,
                                    'getInitialState'
                                ) ? $activity->content->getInitialState() : null,
                            ]
                        ])->toArray()
                    )
                ]
            )->toArray();
            $lastId = CourseState::query()
                ->orderBy('id', 'desc')
                ->limit(1)
                ->pluck('id')
                ->first() ?? 0;
            CourseState::query()
                ->insertOrIgnore($courses->flatMap(
                    fn($course) => $user_ids->map(fn($user_id) => [
                        'user_id' => $user_id,
                        'course_id' => $course->id,
                        'activities' => $activityStates[$course->id],
                        'completed_at' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ])
                )->toArray());
            $states = CourseState::where('id', '>', $lastId)->get();
            foreach ($courses as $course) {
                $courseStates = $states->where('course_id', $course->id);
                $course->setRelation('states', $course->relationLoaded('states')
                    ? $course->states->merge($courseStates) : $courseStates);
            }
            return $states;
        });
    }
}
