<?php

namespace FossHaas\Courses\Http\Controllers;

use FossHaas\Courses\Models\Activity;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Services\CourseStateService;
use Illuminate\Support\Facades\Redirect;

class WeblinkActivityController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Course $course, Activity $activity, CourseStateService $courseStateService)
    {
        if ($activity->content_type !== 'weblink') {
            abort(404);
        }
        $courseStateService->markActivityAsCompleted($course, $activity);
        return Redirect::to($activity->content->url);
    }
}
