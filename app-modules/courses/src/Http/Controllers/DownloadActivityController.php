<?php

namespace FossHaas\Courses\Http\Controllers;

use FossHaas\Courses\Models\Activity;
use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Services\CourseStateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadActivityController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Course $course, Activity $activity, CourseStateService $courseStateService)
    {
        if ($activity->content_type !== 'download') {
            abort(404);
        }
        $courseStateService->markActivityAsCompleted($course, $activity);
        return Storage::download(
            $activity->base_file_path . '/' . $activity->content->filename,
            $activity->content->filename
        );
    }
}
