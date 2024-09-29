<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\CourseGroup;
use FossHaas\Courses\Services\CourseStateService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseGroupView extends Component
{
    public CourseGroup $courseGroup;
    /** Collection<int,CourseGroup> */
    public Collection $courseGroups;
    /** Collection<int,Course> */
    public Collection $courses;

    public function mount(CourseGroup $courseGroup, CourseStateService $courseStateService)
    {
        $this->courseGroup = $courseGroup;
        $this->courseGroups = $courseGroup->courseGroups()
            ->forUser()
            ->ordered()
            ->with([
                'recursiveCourses' => fn($query) => $query->forUser(),
                'recursiveCourses.states' => fn($query) => $query->forUser()->limit(1),
            ])
            ->get();
        $this->courses = $courseGroup->courses()
            ->forUser()
            ->ordered()
            ->with(['states' => fn($query) => $query->forUser()->limit(1)])
            ->get();
        $courseStateService->createStatesForCourses(
            $this->courseGroups->flatMap(fn($courseGroup) => $courseGroup->recursiveCourses)
                ->merge($this->courses)->filter(fn($course) => $course->states->isEmpty()),
            collect([Auth::user()])
        );
    }

    public function render()
    {
        return view('courses::livewire.course-group-view');
    }
}
