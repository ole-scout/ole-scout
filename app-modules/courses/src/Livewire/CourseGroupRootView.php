<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseGroup;
use FossHaas\Courses\Models\CourseState;
use FossHaas\Courses\Services\CourseStateService;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseGroupRootView extends Component
{
    /** Collection<int,CourseGroup> */
    public Collection $courseGroups;
    /** Collection<int,Course> */
    public Collection $courses;

    public function mount(CourseStateService $courseStateService)
    {
        $this->courseGroups = CourseGroup::root()
            ->forUser()
            ->ordered()
            ->with([
                'recursiveCourses' => fn($query) => $query->forUser(),
                'recursiveCourses.enrollments' => fn($query) => $query->forUser()->limit(1),
                'recursiveCourses.states' => fn($query) => $query->forUser()->limit(1),
            ])
            ->get();
        $this->courses = Course::root()
            ->forUser()
            ->ordered()
            ->with([
                'enrollments' => fn($query) => $query->forUser()->limit(1),
                'states' => fn($query) => $query->forUser()->limit(1),
            ])
            ->get();
        $courseStateService->createStatesForCourses(
            $this->courseGroups->flatMap(fn($courseGroup) => $courseGroup->recursiveCourses)
                ->merge($this->courses)->filter(fn($course) => $course->states->isEmpty()),
            collect([Auth::user()])
        );
    }

    public function render()
    {
        return view('courses::livewire.course-group-root-view');
    }
}
